<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Kalender;
use App\Models\Product;

class KalenderController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'produk_id' => 'required',
                // 'user_id' => 'required',
                // 'alamat' => 'required|max:255',
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
            
            // Calculate harga jilid
            $hargaJilid = 0;
            if ($request->jilid === 'kaleng') {
                $hargaJilid = 1000 * $jc;
            } else if ($request->jilid === 'spiral') {
                $hargaJilid = 3500 * $jc;
            }
            
            $totalHarga = $harga + $hargaLaminasi + $hargaJilid;
            
            $transaksi = Transaksi::create([
                'user_id' => auth()->user()->id,
                'nomor_pesanan' => rand(100, 1000),
                'produk_id' => 3,
                'alamat' => auth()->user()->alamat,
                'harga_plano' => $hp,
                'jml_total' => $jc,
                'total_harga' => $totalHarga,
                'gramasi' => $selectedKertas,
                'laminasi' => $request->laminasi,
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
            return view('client.checkout', compact('transaksi', 'kalender', 'products'));
        }
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
}
