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
use Illuminate\Support\Facades\Log;

class KalenderController extends Controller
{
    public function store(Request $request)
    {
        try {
            //code...
            if (auth()->user()->no_telp != true || auth()->user()->alamat != true || auth()->user()->provinsi != true || auth()->user()->kota != true || auth()->user()->kecamatan != true) {
                return redirect()->back()->with('alert', 'Lengkapi data profil terlebih dahulu');
            }
            $request->validate([
                'lembar' => 'required',
                'jilid' => 'required',
                'uk_asli' => 'required',
                'uk_width' => 'required|numeric',
                'uk_height' => 'required|numeric',
            ]);

            // $ukuranData = [
            //     'plano4' => [
            //         'width' => 39.5,
            //         'height' => 54.5,
            //         'hp' => 4800,
            //         'plano' => [79, 109],
            //         'prices' => [
            //             '120' => 2900,
            //             '150' => 3500,
            //         ]
            //     ],
            //     'plano7' => [
            //         'width' => 36,
            //         'height' => 52,
            //         'hp' => 3500,
            //         'plano' => [72, 104],
            //         'prices' => [
            //             '120' => 2500,
            //             '150' => 3000,
            //         ]
            //     ],
            //     // Add more sizes as necessary
            // ];

            $produk = Product::where('judul', 'Kalender')->first();
            $ukuranList = Ukuran::where('product_id', $produk->id)->get();
            $ukuranData = [];

            // foreach ($ukuran as $key => $value) {
            //     $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get();

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
            //             $planoArray = [];
            //             foreach ($detail_values as $detail_value) {
            //                 if ($detail_value->nama_value_ukuran == 'plano') {
            //                     $planoArray[] = $detail_value->value;
            //                 } else {
            //                     $detailUkuranArray[$detail_ukuran->nama_detail_ukuran][$detail_value->nama_value_ukuran] = $detail_value->value;
            //                 }
            //             }
            //             if (!empty($planoArray)) {
            //                 $detailUkuranArray[$detail_ukuran->nama_detail_ukuran]['plano'] = implode(', ', $planoArray);
            //             }
            //         }
            //     }
            //     $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
            // }
            foreach ($ukuranList as $key => $value) {
                $detail_ukurans = DetailUkuran::where('ukuran_id', $value->id)->get();
                $detailUkuranArray = [];

                foreach ($detail_ukurans as $detail_ukuran) {
                    $detail_values = DetailValueUkuran::where('detail_ukuran_id', $detail_ukuran->id)->get();

                    if (strtolower($detail_ukuran->nama_detail_ukuran) === 'plano') {
                        $planoValues = [];
                        foreach ($detail_values as $detail_value) {
                            $planoValues[] = $detail_value->value;
                        }
                        $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $planoValues;
                    } elseif (count($detail_values) === 1) {
                        $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $detail_values->first()->value;
                    } else {
                        $prices = [];
                        foreach ($detail_values as $detail_value) {
                            $prices[$detail_value->nama_value_ukuran] = $detail_value->value;
                        }
                        $detailUkuranArray[$detail_ukuran->nama_detail_ukuran] = $prices;
                    }
                }

                $ukuranData[$value->nama_ukuran] = $detailUkuranArray;
            }

            // dd($ukuranData, $request->all());
            $selectedUkuran = $request->ukuran;
            $selectedKertas = $request->gramasi;
            $jc = $request->jumlah;
            $requestDesain = $request->request_desain;
            $metodePengambilan = $request->metode_pengambilan;

            if (isset($ukuranData[$selectedUkuran])) {
                $ukuran = $ukuranData[$selectedUkuran];
                $ukAsli = $ukuran['plano'] ?? null;
                $ukWidth = $ukuran['width'] ?? 0;
                $ukHeight = $ukuran['height'] ?? 0;
                $hp = $ukuran['prices'][$selectedKertas] ?? 0;

                if ($ukAsli === null || !is_array($ukAsli) || count($ukAsli) < 2 || $ukWidth <= 0 || $ukHeight <= 0 || $hp <= 0) {
                    return redirect()->back()->with('alert', 'Ukuran atau Plano tidak valid');
                }

                $jumlahPagePerPlano = floor($ukAsli[0] / $ukWidth) * floor($ukAsli[1] / $ukHeight);
                $jumlahPlano = ceil($jc / $jumlahPagePerPlano);

                // Penyesuaian jumlah plano berdasarkan jumlah lembar
                $jumlahPlano *= $request->lembar;

                $jsc = $this->calculateJSC($ukWidth, $ukHeight, $jc);
                $harga = $jumlahPlano * $hp + $jsc;
                $hargaLaminasi = $this->calculateLaminasiCost($ukWidth, $ukHeight, $jc, $request->laminasi);

                // dd($jumlahPlano);

                // Calculate harga jilid
                $hargaJilid = 0;
                if ($request->jilid === 'kaleng') {
                    $hargaJilid = 1000 * $jc;
                } elseif ($request->jilid === 'spiral') {
                    $hargaJilid = 3500 * $jc;
                }

                $totalHarga = $harga + $hargaLaminasi + $hargaJilid;
                // dd($ukuran, $ukAsli, $ukWidth, $ukHeight, $jumlahPagePerPlano .'jumlah page per plano', $jumlahPlano, $jc,  $hp, $jsc, $harga, $hargaLaminasi, $totalHarga);

                // $gambar = $request->input('gambar');
                // if (!empty($gambar)) {
                //     $gambar = uniqid() . '_' . $request->file('gambar')->getClientOriginalName();
                //     $request->file('gambar')->move('payment', $gambar);
                // }

                if ($requestDesain == 0) {
                    // Jika pengguna memilih Request Desain
                    $totalHarga += 85000;
                }

                if ($metodePengambilan == 0) {
                    $provinceName = auth()->user()->provinsi;
                    $city = auth()->user()->kota;

                    // Fetch province ID
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

                    // $shippingCost = reset($shippingCost)['cost'][0]['value'];
                    $firstShippingCost = reset($shippingCost);

                    if (is_array($firstShippingCost)) {
                        $shippingCost = $firstShippingCost['cost'][0]['value'];
                    } else {
                        // Tangani kasus di mana $shippingCost kosong atau tidak valid
                    }

                    // Add shipping cost to total price
                    // $totalHarga += $shippingCost;
                    if (is_array($shippingCost) && isset($shippingCost[0])) {
                        $totalHarga += $shippingCost[0]; // Pastikan $shippingCost[0] adalah numerik
                    } elseif (is_numeric($shippingCost)) {
                        $totalHarga += $shippingCost;
                    } else {
                        // Tangani kasus di mana $shippingCost tidak valid
                    }
                }

                $transaksi = Transaksi::create([
                    'user_id' => auth()->user()->id,
                    'nomor_pesanan' => uniqid(),
                    'produk_id' => 3,
                    'alamat' => auth()->user()->alamat,
                    'harga_plano' => $hp,
                    'jml_total' => $jc,
                    'total_harga' => $totalHarga,
                    'gramasi' => $selectedKertas,
                    'laminasi' => $request->laminasi,
                    'metode_pengambilan' => $request->metode_pengambilan,
                    'request_desain' => $requestDesain,
                    'gambar' => $request->gambar,
                ]);

                $products = Product::all();

                $kalender = Kalender::create([
                    'transaksi_id' => $transaksi->id,
                    'lembar' => $request->lembar,
                    'jilid' => $request->jilid,
                    'uk_asli' => $request->uk_asli,
                    'uk_width' => $ukWidth,
                    'uk_height' => $ukHeight,
                    // 'produk_id' => $request->produk_id,
                    // 'user_id' => $request->user_id,
                    // 'alamat' => $request->alamat,
                    // 'total_harga' => $totalHarga,
                    // 'harga_plano' => $hp,
                    // 'jumlah' => $request->jumlah,
                    // 'gramasi' => $request->gramasi,
                    // 'status' => "Menunggu Konfirmasi",
                    // 'laminasi' => $request->laminasi,
                ]);

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

                // dd($totalHarga, $params);
            }
            return view('client.checkout', compact('transaksi', 'kalender', 'products', 'token'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
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
