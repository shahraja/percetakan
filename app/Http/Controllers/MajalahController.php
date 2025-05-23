<?php

namespace App\Http\Controllers;

use App\Mail\NotifMail;
use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Majalah;
use App\Models\Product;
use App\Models\Ukuran;
use App\Services\CreateSnapToken;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class MajalahController extends Controller
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
            ]);

            // Ambil data dari request
            $produk_id = $request->produk_id;
            $user_id = $request->user_id;
            $alamat = $request->alamat;
            $gramasi = $request->gramasi;
            $finishing = $request->finishing;
            $hargaTotal = $this->calculateTotalPrice($request); // Hitung total harga menggunakan fungsi baru
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
            $shippingCost = $request->input('shipping_cost');

            if ($metode_pengambilan == '0') {
                $provinceName = auth()->user()->provinsi;
                $city = auth()->user()->kota;

                // Fetch province ID
                // $api_key = env('RAJA_ONGKIR_KEY');
                $api_key = Config::get('app.rajaongkir');
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

                $firstShippingCost = reset($shippingCost);

                if (is_array($firstShippingCost)) {
                    $shippingCost = $firstShippingCost['cost'][0]['value'];
                } else {
                    // Tangani kasus di mana $shippingCost kosong atau tidak valid
                }

                // Add shipping cost to total price
                // $totalHarga += $shippingCost;
                if (is_array($shippingCost) && isset($shippingCost[0])) {
                    $hargaTotal += $shippingCost[0]; // Pastikan $shippingCost[0] adalah numerik
                } elseif (is_numeric($shippingCost)) {
                    $hargaTotal += $shippingCost;
                } else {
                    // Tangani kasus di mana $shippingCost tidak valid
                }
            }

            if ($request_desain == '0') {
                $hargaTotal += 85000; // Tambahkan biaya desain sebesar 85.000
            }

            $transaksi = Transaksi::create([
                'user_id' => auth()->user()->id,
                'nomor_pesanan' => uniqid(),
                'produk_id' => 5,
                'alamat' => auth()->user()->alamat,
                'harga_plano' => $harga_plano,
                'jml_total' => $jumlah,
                'total_harga' => $hargaTotal,
                'gramasi' => $gramasi,
                'laminasi' => $laminasi,
                'metode_pengambilan' => $metode_pengambilan,
                'request_desain' => $request_desain,
                'status' => 'Menunggu Pembayaran',
                'shipping_cost' => is_numeric($shippingCost) ? $shippingCost : (is_array($shippingCost) && isset($shippingCost[0]) ? $shippingCost[0] : 0),
            ]);

            $products = Product::all();

            // Simpan ke database
            $majalah = Majalah::create([
                'transaksi_id' => $transaksi->id,
                'halaman' => $halaman,
                'uk_asli' => $uk_asli,
                'uk_width' => $uk_width,
                'uk_height' => $uk_height,
                'finishing' => $finishing,
            ]);

            $transaction_details = [
                'order_id' => $transaksi->nomor_pesanan,
                'gross_amount' => intval($hargaTotal),
            ];
            $items = [
                [
                    'id' => 5,
                    'quantity' => 1,
                    'price' => intval($hargaTotal),
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
            Mail::to(auth()->user()->email)->send(new NotifMail($transaksi));

            return view('client.checkout', compact('transaksi', 'majalah', 'products', 'token'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    private function calculateUkuranData($ukuran, $param, $kertas)
    {
        $produk = Product::where('judul', 'Majalah')->first();
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

        // Directly access the numeric value for width and height
        if ($param === 'width' || $param === 'height') {
            return isset($ukuranData[$ukuran][$param]) ? $ukuranData[$ukuran][$param] : null;
        }

        if ($kertas === null) {
            return $ukuranData[$ukuran][$param] ?? null;
        }

        return isset($ukuranData[$ukuran][$param][$kertas]) ? intval($ukuranData[$ukuran][$param][$kertas]) : null;
    }

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
