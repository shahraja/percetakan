<?php

namespace App\Http\Controllers;

use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Kalender;
use App\Models\Product;
use App\Models\Ukuran;
use App\Services\CreateSnapToken;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

class KalenderController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Validasi input pengguna
            if (auth()->user()->alamat != true || auth()->user()->provinsi != true || auth()->user()->kota != true || auth()->user()->kecamatan != true) {
                return redirect()->back()->with('alert', 'Lengkapi data profil terlebih dahulu');
            }

            $request->validate([
                'produk_id' => 'required',
                'gambar' => 'file|image|mimes:jpeg,png,jpg|max:5120',
                'jumlah' => 'required|numeric',
                'gramasi' => 'required',
                'lembar' => 'required',
                'jilid' => 'required',
                'laminasi' => 'required',
                'uk_asli' => 'required',
                'uk_width' => 'required|numeric',
                'uk_height' => 'required|numeric',
            ]);

            // Ambil data ukuran dari database
            $produk = Product::where('judul', 'Kalender')->first();
            $ukuran = Ukuran::where('product_id', $produk->id)->get();
            $ukuranData = [];

            // Ambil data ukuran
            foreach ($ukuran as $value) {
                $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get();
                $detailUkuranArray = [];

                foreach ($detail_ukurans as $detail_ukuran) {
                    $detail_values = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();
                    if ($detail_ukuran->is_parent) {
                        $childArray = [];
                        foreach ($detail_values as $childDetail) {
                            $childArray[$childDetail->nama_value_ukuran] = $childDetail->value;
                        }
                        $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $childArray;
                    } else {
                        $planoArray = [];
                        foreach ($detail_values as $detail_value) {
                            if ($detail_value->nama_value_ukuran == 'plano') {
                                $planoArray[] = $detail_value->value;
                            } else {
                                $detailUkuranArray[$detail_ukuran->nama_detail_ukuran][$detail_value->nama_value_ukuran] = $detail_value->value;
                            }
                        }
                        if (!empty($planoArray)) {
                            $detailUkuranArray[$detail_ukuran->nama_detail_ukuran]['plano'] = implode(', ', $planoArray);
                        }
                    }
                }
                $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
            }

            $selectedUkuran = $request->input('ukuran');
            $ukWidth = $request->input('uk_width');
            $ukHeight = $request->input('uk_height');
            $jc = $request->input('jumlah');
            // $hp = $request->input('harga_plano');

            // Ambil data plano dari ukuran yang dipilih
            $planoString = $ukuranData[$selectedUkuran]['plano'] ?? '';
            if (is_array($planoString)) {
                $planoString = implode(', ', $planoString);
            }

            // Pecah string menjadi array
            $planoArray = array_map('floatval', explode(', ', $planoString));

            // Cek apakah data plano valid
            if (isset($ukuranData[$selectedUkuran])) {
                $ukuran = $ukuranData[$selectedUkuran];
                $ukAsli = $planoArray;
                $ukWidth = floatval($ukuran['width']);
                $ukHeight = floatval($ukuran['height']);
                $hp = floatval($ukuran['prices'][$request->input('gramasi')]);

                if (is_array($ukAsli) && count($ukAsli) == 2) {
                    $ukAsliWidth = floatval($ukAsli[0]);
                    $ukAsliHeight = floatval($ukAsli[1]);

                    $jumlahPagePerPlano = floor($ukAsliWidth / $ukWidth) * floor($ukAsliHeight / $ukHeight);
                    $jumlahPlano = ceil($jc / $jumlahPagePerPlano);
                    $jumlahPlano *= $request->input('lembar');

                    $jsc = $this->calculateJSC($ukWidth, $ukHeight, $jc);
                    $harga = $jumlahPlano * $hp + $jsc;
                    $hargaLaminasi = $this->calculateLaminasiCost($ukWidth, $ukHeight, $jc, $request->laminasi);

                    $hargaJilid = 0;
                    if ($request->input('jilid') === 'kaleng') {
                        $hargaJilid = 1000 * $jc;
                    } elseif ($request->input('jilid') === 'spiral') {
                        $hargaJilid = 3500 * $jc;
                    }

                    $totalHarga = $harga + $hargaLaminasi + $hargaJilid;

                    // Hitung biaya pengiriman
                    $provinceName = auth()->user()->provinsi;
                    $city = auth()->user()->kota;

                    $api_key = env('RAJA_ONGKIR_KEY');
                    $apiURL = 'https://api.rajaongkir.com/starter/province';

                    $response = Http::withHeaders([
                        'key' => $api_key,
                    ])->get($apiURL);

                    if ($response->successful()) {
                        $provinceResponse = $response->body();
                    } else {
                        return redirect()->back()->with('alert', 'Data Gagal Fetch API Provinsi');
                    }

                    $provinces = json_decode($provinceResponse, true)['rajaongkir']['results'];
                    try {
                        $provinceId = array_filter($provinces, function ($prov) use ($provinceName) {
                            return $prov['province'] === $provinceName;
                        });
                        $provinceId = reset($provinceId)['province_id'];
                    } catch (\Exception $e) {
                        return redirect()->back()->with('alert', 'Alamat Provinsi Tidak Terdaftar');
                    }

                    // Fetch city ID
                    $apiURL = 'https://api.rajaongkir.com/starter/city?province=' . $provinceId;

                    $response = Http::withHeaders([
                        'key' => $api_key,
                    ])->get($apiURL);

                    if (!$response->successful()) {
                        return redirect()->back()->with('alert', 'Alamat Provinsi Tidak Terdaftar');
                    }
                    $cityResponse = $response->body();
                    $cities = json_decode($cityResponse, true)['rajaongkir']['results'];
                    $cityId = array_filter($cities, function ($cityItem) use ($city) {
                        return $cityItem['city_name'] === $city;
                    });
                    $cityId = reset($cityId)['city_id'];

                    // Fetch shipping cost
                    $weight = 2000;
                    $origin = 21;
                    $apiURL = 'https://api.rajaongkir.com/starter/cost';
                    $response = Http::withHeaders([
                        'key' => $api_key,
                        'content-type' => 'application/x-www-form-urlencoded',
                    ])
                        ->withBody(
                            http_build_query([
                                'origin' => $origin,
                                'destination' => $cityId,
                                'weight' => $weight,
                                'courier' => 'jne',
                            ]),
                            'application/x-www-form-urlencoded',
                        )
                        ->post($apiURL);
                    $costData = json_decode($response->body(), true);
                    $shippingCost = array_filter($costData['rajaongkir']['results'][0]['costs'], function ($cost) {
                        return $cost['service'] === 'REG';
                    });

                    $shippingCost = reset($shippingCost)['cost'][0]['value'];

                    // Tambahkan biaya pengiriman ke total harga
                    $totalHarga += $shippingCost;
                    // dd($jumlahPagePerPlano, $jumlahPlano, $jsc, $harga, $hargaLaminasi, $hargaJilid, $shippingCost, $totalHarga);

                    // Simpan data transaksi
                    $transaksi = Transaksi::create([
                        'user_id' => auth()->user()->id,
                        'nomor_pesanan' => uniqid(),
                        'produk_id' => 3,
                        'alamat' => auth()->user()->alamat,
                        'harga_plano' => $hp,
                        'jml_total' => $jc,
                        'total_harga' => $totalHarga,
                        'gramasi' => $request->input('gramasi'),
                        'laminasi' => $request->input('laminasi'),
                        'metode_pengambilan' => $request->input('metode_pengambilan'),
                        'gambar' => $request->input('gambar'),
                    ]);

                    $products = Product::all();

                    // Simpan data kalender
                    $kalender = Kalender::create([
                        'transaksi_id' => $transaksi->id,
                        'lembar' => $request->input('lembar'),
                        'jilid' => $request->input('jilid'),
                        'uk_asli' => $request->input('uk_asli'),
                        'uk_width' => $ukWidth,
                        'uk_height' => $ukHeight,
                    ]);

                    // Persiapkan data untuk Snap Token
                    $transaction_details = [
                        'order_id' => $transaksi->nomor_pesanan,
                        'gross_amount' => intval($totalHarga),
                    ];
                    $items = [
                        [
                            'id' => 3,
                            'quantity' => 1,
                            'price' => intval($totalHarga),
                            'name' => 'Kalender',
                        ],
                    ];

                    $customer_details = [
                        'first_name' => $transaksi->user->name,
                        'email' => $transaksi->user->email,
                        'phone' => $transaksi->user->no_telp,
                        'address' => $transaksi->user->alamat,
                    ];

                    $params = [
                        'transaction_details' => $transaction_details,
                        'item_details' => $items,
                        'customer_details' => $customer_details,
                    ];
                    $snapToken = new CreateSnapToken($params);
                    $token = $snapToken->getSnapToken();

                    // Arahkan ke halaman checkout dengan data transaksi
                    return view('client.checkout', compact('transaksi', 'kalender', 'products', 'token'));
                } else {
                    return redirect()->back()->with('alert', 'Data ukuran plano tidak valid.');
                }
            } else {
                return redirect()->back()->with('alert', 'Ukuran tidak ditemukan.');
            }
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('alert', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    private function calculateJSC($width, $height, $jc)
    {
        if ($width <= 37 && $height <= 52 && $jc <= 2500) {
            return 360000;
        } elseif (($width > 37 || $height > 52) && $jc <= 2500) {
            return 440000;
        } else {
            return 0;
        }
    }

    private function calculateLaminasiCost($width, $height, $jc, $laminasi)
    {
        $area = $width * $height;
        switch ($laminasi) {
            case 'glossy1':
                return $area * 0.19 * $jc;
            case 'glossy2':
                return $area * 0.19 * $jc * 2;
            case 'doff1':
                return $area * 0.2 * $jc;
            case 'doff2':
                return $area * 0.2 * $jc * 2;
            default:
                return 0;
        }
    }
}


 // foreach ($ukuran as $key => $value) {
        //     $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get(); // Mengambil semua detail ukuran

        //     $detailUkuranArray = [];
        //     foreach ($detail_ukurans as $detail_ukuran) {
        //         $detail_values = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();

        //         if ($detail_ukuran->is_parent) {
        //             $childArray = [];
        //             foreach ($detail_values as $childDetail) {
        //                 $childArray[$childDetail->nama_value_ukuran] = $childDetail->value;
        //             }
        //             $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $childArray;
        //         } else {
        //             // Jika ada beberapa value untuk 'plano', simpan dalam array
        //             $planoArray = [];
        //             foreach ($detail_values as $detail_value) {
        //                 if ($detail_value->nama_value_ukuran == 'plano') {
        //                     $planoArray[] = $detail_value->value;
        //                 } else {
        //                     $detailUkuranArray[$detail_ukuran->nama_detail_ukuran][$detail_value->nama_value_ukuran] = $detail_value->value;
        //                 }
        //             }
        //             // Tambahkan array 'plano' ke detail ukuran jika ada data
        //             if (!empty($planoArray)) {
        //                 $detailUkuranArray[$detail_ukuran->nama_detail_ukuran]['plano'] = implode(', ', $planoArray);
        //             }
        //         }
        //     }

        //     $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
        // }