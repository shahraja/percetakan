<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Kalender;
use App\Models\Product;
use App\Services\CreateSnapToken;

class KalenderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'produk_id' => 'required',
                // 'user_id' => 'required',
                // 'alamat' => 'required|max:255',
                'gambar' => 'file|image|mimes:jpeg,png,jpg|max:5120',
                'jumlah' => 'required|numeric',
                'gramasi' => 'required',
                'lembar' => 'required',
                'jilid' => 'required',
                'laminasi' => 'required',
                'uk_asli' => 'required',
                'uk_width' => 'required|numeric',
                'uk_height' => 'required|numeric'
            ]
        );

        $ukuranData = [
            'plano4' => [
                'width' => 39.5,
                'height' => 54.5,
                'hp' => 4800,
                'plano' => [79, 109],
                'prices' => [
                    '120' => 2900,
                    '150' => 3500,
                ]
            ],
            'plano7' => [
                'width' => 36,
                'height' => 52,
                'hp' => 3500,
                'plano' => [72, 104],
                'prices' => [
                    '120' => 2500,
                    '150' => 3000,
                ]
            ],
            // Add more sizes as necessary
        ];

        $selectedUkuran = $request->ukuran;
        $selectedKertas = $request->gramasi;
        $jc = $request->jumlah;
        
        if (isset($ukuranData[$selectedUkuran])) {
            $ukuran = $ukuranData[$selectedUkuran];
            $ukAsli = $ukuran['plano'];
            $ukWidth = $ukuran['width'];
            $ukHeight = $ukuran['height'];
            $hp = $ukuran['prices'][$selectedKertas];
            
            $jumlahPagePerPlano = floor($ukAsli[0] / $ukWidth) * floor($ukAsli[1] / $ukHeight);
            $jumlahPlano = ceil($jc / $jumlahPagePerPlano);
            $jumlahPlano *= $request->lembar; // Adjust jumlahPlano based on lembar
            
            $jsc = $this->calculateJSC($ukWidth, $ukHeight, $jc);
            $harga = ($jumlahPlano * $hp) + $jsc;
            $hargaLaminasi = $this->calculateLaminasiCost($ukWidth, $ukHeight, $jc, $request->laminasi);
            
            // dd($request->all());

            // Calculate harga jilid
            $hargaJilid = 0;
            if ($request->jilid === 'kaleng') {
                $hargaJilid = 1000 * $jc;
            } else if ($request->jilid === 'spiral') {
                $hargaJilid = 3500 * $jc;
            }
            
            $totalHarga = $harga + $hargaLaminasi + $hargaJilid;

            $gambar = $request->input('gambar');
            if (!empty($gambar)) {
                $gambar = uniqid() . '_' . $request->file('gambar')->getClientOriginalName();
                $request->file('gambar')->move('payment', $gambar);
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
                // 'metode_pengambilan' => $request->metode_pengambilan,
                'gambar' => $request->gambar,

                
            ]);

            $products = Product::all();

            $kalender = Kalender::create([
                'transaksi_id' => $transaksi->id,
                'lembar' => $request->lembar,
                'jilid' => $request->jilid,
                'uk_asli' => $request->uk_asli,
                'uk_width' => $ukWidth,
                'uk_height' => $ukHeight
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
                'order_id'      => $transaksi->nomor_pesanan,
                'gross_amount'  => intval($totalHarga),
            ];
            $items = [
                [
                    'id'    => 3,
                    'quantity'  => 1,
                    'price' => intval($totalHarga),
                    'name'  => 'Kalender',
                ]
            ];
    
            $customer_details = [
                'first_name'          => $transaksi->user->name,
                'email'         => $transaksi->user->email,
                'phone'         => $transaksi->user->no_telp,
                'address'       => $transaksi->user->alamat,
            ];
    
            $params = [
                'transaction_details'   => $transaction_details,
                'item_details'          => $items,
                'customer_details'      => $customer_details,
            ];
            $snapToken = new CreateSnapToken($params);
            $token = $snapToken->getSnapToken();

            // dd($totalHarga, $params);

            return view('client.checkout', compact('transaksi', 'kalender', 'products', 'token'));
        }
    }
    public function payment_post(Request $request)
    {
        $json = json_decode($request->get('json'));
        $transaksi = new Transaksi();
        $transaksi->payment_type = $json->payment_type;
        $transaksi->payment_code = $json->payment_code;
        $transaksi->payment_url = $json->payment_url;
        $transaksi->save();
        // return redirect($transaksi->payment_url);
    } 

    private function calculateJSC($width, $height, $jc)
    {
        if ($width <= 37 && $height <= 52 && $jc <= 2500) {
            return 360000;
        } else if (($width > 37 || $height > 52) && $jc <= 2500) {
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
                return $area * 0.20 * $jc;
            case 'doff2':
                return $area * 0.20 * $jc * 2;
            default:
                return 0;
        }
    }

    public function updateStatus(Request $request)
    {
        // Validasi input jika perlu
        $transaksi = Transaksi::find($request->input('id'));

        if ($transaksi) {
            $transaksi->status = $request->input('status');
            $transaksi->save();

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }
}
