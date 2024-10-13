<?php

namespace App\Http\Controllers;

use App\Mail\NotifMail;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Brosur;
use App\Models\DetailUkuran;
use App\Models\DetailValueUkuran;
use App\Models\Product;
use App\Models\Ukuran;
use App\Services\CreateSnapToken;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class BrosurController extends Controller
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
                'uk_height' => 'required',
            ]);

            $ukuranData = $this->getUkuranData();

            // Ambil input dari form
            $ukuran = $request->ukuran;
            $gramasi = $request->gramasi;
            $jumlahCetak = $request->jumlah;
            $laminasi = $request->laminasi;
            $requestDesain = $request->request_desain;
            $metodePengambilan = $request->metode_pengambilan;
            $shippingCost = $request->input('shipping_cost');

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

            // Lanjutkan logika lain sesuai kebutuhan

            if ($requestDesain == 0) {
                // Jika pengguna memilih Request Desain
                $totalHarga += 85000;
            }

            if ($metodePengambilan == 0) {
                $provinceName = auth()->user()->provinsi;
                $city = auth()->user()->kota;

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
                        return $prov['province'] == $provinceName;
                    });

                    $provinceId = reset($provinceId)['province_id'];
                } catch (\Exception $e) {
                    return redirect()->back()->with('alert', 'Alamat Provinsi Tidak Terdaftar');
                }

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
                }

                if (is_numeric($shippingCost)) {
                    $totalHarga += $shippingCost;
                }
            }

            $transaksi = Transaksi::create([
                'user_id' => auth()->user()->id,
                'nomor_pesanan' => uniqid(),
                'produk_id' => 2,
                'alamat' => auth()->user()->alamat,
                'harga_plano' => $hp,
                'jml_total' => $jumlahCetak,
                'total_harga' => $totalHarga,
                'gramasi' => $gramasi,
                'laminasi' => $laminasi,
                'request_desain' => $requestDesain,
                'metode_pengambilan' => $metodePengambilan,
                'status' => "Menunggu Pembayaran",
                'shipping_cost' => is_numeric($shippingCost) ? $shippingCost : (is_array($shippingCost) && isset($shippingCost[0]) ? $shippingCost[0] : 0),
            ]);

            $products = Product::all();

            $brosur = Brosur::create([
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
                    'id' => 2,
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
            Mail::to(auth()->user()->email)->send(new NotifMail($transaksi));

            return view('client.checkout', compact('transaksi', 'brosur', 'products', 'token', 'shippingCost'));
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()
                ->back()
                ->withErrors($e->validator)
                ->withInput();
        }
    }

    private function getUkuranData()
    {
        $produk = Product::where('judul', 'Brosur')->first();
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
