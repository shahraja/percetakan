<?php

namespace App\Http\Controllers;

use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Ukuran;
use Illuminate\Http\Request;
use App\Models\Undangan;
use App\Services\CreateSnapToken;
use Illuminate\Support\Facades\Http;

class UndanganController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (auth()->user()->no_telp != true || auth()->user()->alamat != true || auth()->user()->provinsi != true || auth()->user()->kota != true || auth()->user()->kecamatan != true) {
                return redirect()->back()->with('alert', 'Lengkapi data profil terlebih dahulu');
            }
            $request->validate([
                'uk_asli' => 'required',
                'uk_width' => 'required',
                'uk_height' => 'required'
            ]);

            // $ukuranData = [
            //     'plano1' => [
            //         'width' => 30.5,
            //         'height' => 46,
            //         'hp' => 3200,
            //         'plano' => [61, 92],
            //         'prices' => [
            //             '120' => 2000,
            //             '150' => 2300,
            //             '190' => 2950,
            //             '210' => 3200,
            //             '230' => 3500,
            //         ],
            //     ],
            //     'plano2' => [
            //         'width' => 32.5,
            //         'height' => 45,
            //         'hp' => 3400,
            //         'plano' => [65, 90],
            //         'prices' => [
            //             '120' => 2100,
            //             '150' => 2450,
            //             '190' => 3050,
            //             '210' => 3400,
            //             '230' => 3600,
            //             '260' => 4050,
            //             '310' => 4800,
            //         ],
            //     ],
            //     'plano3' => [
            //         'width' => 32.5,
            //         'height' => 50,
            //         'hp' => 3700,
            //         'plano' => [65, 100],
            //         'prices' => [
            //             '120' => 2250,
            //             '150' => 2700,
            //             '190' => 3400,
            //             '210' => 3700,
            //             '230' => 4000,
            //             '260' => 4500,
            //             '310' => 5200,
            //         ],
            //     ],
            //     'plano4' => [
            //         'width' => 39.5,
            //         'height' => 54.5,
            //         'hp' => 4800,
            //         'plano' => [79, 109],
            //         'prices' => [
            //             '120' => 2900,
            //             '150' => 3500,
            //             '190' => 4400,
            //             '210' => 4800,
            //             '230' => 5200,
            //             '260' => 5800,
            //             '310' => 7000,
            //             '400' => 8800,
            //         ],
            //     ],
            //     'plano5' => [
            //         'width' => 36,
            //         'height' => 39,
            //         'hp' => 4800,
            //         'plano' => [79, 109],
            //         'prices' => [
            //             '120' => 2900,
            //             '150' => 3500,
            //             '190' => 4400,
            //             '210' => 4800,
            //             '230' => 5200,
            //             '260' => 5800,
            //             '310' => 7000,
            //             '400' => 8800,
            //         ],
            //     ],
            //     'plano6' => [
            //         'width' => 35,
            //         'height' => 44,
            //         'hp' => 4800,
            //         'plano' => [79, 109],
            //         'prices' => [
            //             '120' => 2900,
            //             '150' => 3500,
            //             '190' => 4400,
            //             '210' => 4800,
            //             '230' => 5200,
            //             '260' => 5800,
            //             '310' => 7000,
            //             '400' => 8800,
            //         ],
            //     ],
            // ];

            $ukuranData = $this->getUkuranData();

            $ukuran = $request->ukuran;
            $gramasi = $request->gramasi;
            $jumlahCetak = $request->jumlah;
            $laminasi = $request->laminasi;
            $requestDesain = $request->request_desain;
            $metodePengambilan = $request->metode_pengambilan;

            $ukuranData = $this->getUkuranData();
            $selectedUkuran = $ukuranData[$ukuran];

            if (!isset($selectedUkuran['width']) || !isset($selectedUkuran['height']) || !isset($selectedUkuran['prices']) || !isset($selectedUkuran['plano'])) {
                return redirect()->back()->with('alert', 'Data ukuran tidak valid atau tidak lengkap.');
            }

            $hp = $selectedUkuran['prices'][$gramasi];

            if (isset($selectedUkuran['plano']) && count($selectedUkuran['plano']) == 2) {
                $jumlahPagePerPlano = floor($selectedUkuran['plano'][0] / $selectedUkuran['width']) * floor($selectedUkuran['plano'][1] / $selectedUkuran['height']);
            } else {
                return redirect()->back()->with('alert', 'Data ukuran plano tidak valid atau tidak ditemukan.');
            }

            $jumlahPlano = ceil($jumlahCetak / $jumlahPagePerPlano);

            $jsc = $this->calculateJSC($selectedUkuran['width'], $selectedUkuran['height'], $jumlahCetak);
            $harga = $jumlahPlano * $hp + $jsc;
            $hargaLaminasi = $this->calculateLaminasiCost($selectedUkuran['width'], $selectedUkuran['height'], $jumlahCetak, $laminasi);

            $totalHarga = $harga + $hargaLaminasi;

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
    
                $shippingCost = reset($shippingCost)['cost'][0]['value'];
    
                // Add shipping cost to total price
                $totalHarga += $shippingCost;
            }


            $transaksi = Transaksi::create([
                'user_id' => auth()->user()->id,
                'nomor_pesanan' => uniqid(),
                'produk_id' => 4,
                'alamat' => auth()->user()->alamat,
                'harga_plano' => $hp,
                'jml_total' => $jumlahCetak,
                'total_harga' => $totalHarga,
                'gramasi' => $gramasi,
                'laminasi' => $laminasi,
                'request_desain' => $requestDesain,
                'metode_pengambilan' => $metodePengambilan,
            ]);

            $products = Product::all();

            $undangan = Undangan::create([
                'transaksi_id' => $transaksi->id,
                'uk_asli' => $request->uk_asli,
                'uk_width' => $request->uk_width,
                'uk_height' => $request->uk_height,
            ]);

            $transaction_details = [
                'order_id' => $transaksi->nomor_pesanan,
                'gross_amount' => intval($totalHarga),
            ];
            $items = [
                [
                    'id' => 4,
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

            return view('client.checkout', compact('transaksi', 'undangan', 'products', 'token'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } 
    }

    private function getUkuranData()
    {
        $produk = Product::where('judul', 'Undangan')->first();
        $ukuranList = Ukuran::where('product_id', $produk->id)->get();
        $ukuranData = [];

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
        // dd($ukuranData);

        return $ukuranData;
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
