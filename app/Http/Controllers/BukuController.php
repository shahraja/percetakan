<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use App\Models\Product;
use App\Models\Ukuran;
use App\Services\CreateSnapToken;
use Illuminate\Support\Facades\Http;

class BukuController extends Controller
{
    public function store(Request $request)
    {
        try {
            if (auth()->user()->no_telp != true || auth()->user()->alamat != true || auth()->user()->provinsi != true || auth()->user()->kota != true || auth()->user()->kecamatan != true) {
                return redirect()->back()->with('alert', 'Lengkapi data profil terlebih dahulu');
            }
            $request->validate([
                'halaman' => 'required',
                'uk_asli' => 'required',
                'uk_width' => 'required',
                'uk_height' => 'required',
                'finishing' => 'required',
                'request_desain' => 'required',
                // 'metode_pengambilan' => 'required',
            ]);
            // dd($request->all());
            // Ambil data dari request
            $produk_id = $request->produk_id;
            $user_id = $request->user_id;
            $alamat = $request->alamat;
            $gramasi = $request->gramasi;
            $finishing = $request->finishing;
            $total_harga = $this->calculateTotalPrice($request); // Hitung total harga menggunakan fungsi baru
            $harga_plano = $this->calculateUkuranData($request->ukuran, 'prices', $gramasi);
            $jumlah = $request->jumlah;
            $status = $request->status;
            $halaman = $request->halaman;
            $laminasi = $request->laminasi;
            $uk_asli = $request->uk_asli;
            $uk_width = $request->uk_width;
            $uk_height = $request->uk_height;
            $metode_pengambilan = $request->metode_pengambilan;
            $request_desain = $request->request_desain;

            if($metode_pengambilan == '0'){
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
                $total_harga += $shippingCost;
            }

            if ($request_desain == '0') {
                $total_harga += 85000; // Tambahkan biaya desain sebesar 85.000
            }

            $transaksi = Transaksi::create([
                'user_id' => auth()->user()->id,
                'nomor_pesanan' => uniqid(),
                'produk_id' => 1,
                'alamat' => auth()->user()->alamat,
                'harga_plano' => $harga_plano,
                'jml_total' => $jumlah,
                'total_harga' => $total_harga,
                'gramasi' => $gramasi,
                'laminasi' => $laminasi,
                'metode_pengambilan' => $metode_pengambilan,
                'request_desain' => $request_desain,
            ]);

            $products = Product::all();

            $buku = Buku::create([
                'transaksi_id' => $transaksi->id,
                'halaman' => $halaman,
                'uk_asli' => $uk_asli,
                'uk_width' => $uk_width,
                'uk_height' => $uk_height,
                'finishing' => $finishing,
            ]);

            $transaction_details = [
                'order_id' => $transaksi->nomor_pesanan,
                'gross_amount' => intval($total_harga),
            ];
            $items = [
                [
                    'id' => 1,
                    'quantity' => 1,
                    'price' => intval($total_harga),
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

            return view('client.checkout', compact('transaksi', 'buku', 'products', 'token'));
        } catch (\Exception $e) {
            dd($e);
        }
    }

    private function calculateUkuranData($ukuran, $param, $kertas)
    {
        $produk = Product::where('judul', 'Buku')->first();
        $ukuranList = Ukuran::where('product_id', $produk->id)->get();
        $ukuranData = [];

        foreach ($ukuranList as $key => $value) {
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

        // Directly access the numeric value for width and height
        if ($param === 'width' || $param === 'height') {
            return $ukuranData[$ukuran][$param][$param];
        }

        if ($kertas === null) {
            return $ukuranData[$ukuran][$param];
        }

        if (!isset($ukuranData[$ukuran][$param][$kertas])) {
            throw new \Exception('Invalid kertas key: ' . print_r($kertas, true));
        }

        return intval($ukuranData[$ukuran][$param][$kertas]);
    }

    // private function calculateUkuranData($ukuran, $param, $kertas)
    // {
    //     $ukuranData = [
    //         'A4' => [
    //             'width' => 21,
    //             'height' => 28,
    //             'prices' => [
    //                 '120' => 2000,
    //                 '150' => 2300,
    //             ],
    //         ],
    //         'A5' => [
    //             'width' => 14.8,
    //             'height' => 21,
    //             'prices' => [
    //                 '120' => 2100,
    //                 '150' => 2450,
    //             ],
    //         ],
    //     ];

    //     if ($kertas == null) {
    //         return $ukuranData[$ukuran][$param];
    //     }
    //     return intval($ukuranData[$ukuran][$param][$kertas]);
    // }

    private function calculateTotalPrice(Request $request)
    {
        // Ambil data dari request
        $halaman = $request->halaman;
        $jumlah = $request->jumlah;
        $ukuran = $request->ukuran;
        $kertas = $request->gramasi;
        $laminasi = $request->laminasi;
        $finishing = $request->finishing;

        // Hitung harga kertas berdasarkan pilihan
        $hargaKertas = $this->calculateUkuranData($ukuran, 'prices', $kertas);
        // Hitung harga total berdasarkan logika perhitungan yang ada
        // Anda perlu menyesuaikan ini dengan rumus yang sudah Anda buat di frontend
        $hargaTotal = $this->calculatePriceLogic($halaman, $jumlah, $this->calculateUkuranData($ukuran, 'width', null), $this->calculateUkuranData($ukuran, 'height', null), $ukuran, $hargaKertas, $laminasi, $finishing);

        return $hargaTotal;
    }

    private function calculatePriceLogic($halaman, $jumlah, $width, $height, $ukuran, $hargaKertas, $laminasi, $finishing)
    {
        $keteren = ceil($halaman / 8);
        $jumlahPagePerPlano = ceil($jumlah / 2);
        $jumlahPlano = $jumlahPagePerPlano * $keteren;

        $jsc = $this->calculateJSC($width, $height, $jumlah);
        $harga = $jumlahPlano * $hargaKertas + $jsc * 2;
        $hargaLaminasi = $this->calculateLaminasiCost($width, $height, $jumlah, $laminasi);
        $harga += $hargaLaminasi;

        if ($finishing === 'steples') {
            $harga += $jumlah * 1000;
        } elseif ($finishing === 'binding') {
            $harga += $jumlah * 2000;
        }

        return $harga;
    }

    private function calculateJSC($width, $height, $jc)
    {
        // Fungsi perhitungan JSC
        // Sesuaikan dengan logika dari frontend
        if ($width <= 21 && $height <= 28) {
            return 440000;
        } elseif ($width <= 14.8 && $height <= 21) {
            return 360000;
        } else {
            return 0;
        }
    }

    private function calculateLaminasiCost($width, $height, $jc, $laminasi)
    {
        // Fungsi perhitungan biaya laminasi
        // Sesuaikan dengan logika dari frontend
        if (is_array($width) || is_array($height)) {
            throw new \Exception('Width or height is an array. Width: ' . print_r($width, true) . ' Height: ' . print_r($height, true));
        }
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
