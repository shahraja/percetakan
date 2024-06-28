<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Brosur;

class BrosurController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                // 'nama_produk' => 'required', 
                // 'user_id' => 'required', 
                // 'alamat' => 'required|max:255', 
                // 'total_harga' => 'required', 
                // 'harga_plano' => 'required', 
                // 'jumlah' => 'required', 
                // 'gramasi' => 'required', 
                // 'laminasi' => 'required', 
                // 'uk_asli' => 'required', 
                // 'uk_width' => 'required', 
                // 'uk_height' => 'required'
            ]
        );

        $ukuranData = [
            'plano1' => [
                'width' => 30.5,
                'height' => 46,
                'hp' => 3200,
                'plano' => [61, 92],
                'prices' => [
                    '120' => 2000,
                    '150' => 2300,
                    '190' => 2950,
                    '210' => 3200,
                    '230' => 3500,
                ]
            ],
            'plano2' => [
                'width' => 32.5,
                'height' => 45,
                'hp' => 3400,
                'plano' => [65, 90],
                'prices' => [
                    '120' => 2100,
                    '150' => 2450,
                    '190' => 3050,
                    '210' => 3400,
                    '230' => 3600,
                    '260' => 4050,
                    '310' => 4800,
                ]
            ],
            'plano3' => [
                'width' => 32.5,
                'height' => 50,
                'hp' => 3700,
                'plano' => [65, 100],
                'prices' => [
                    '120' => 2250,
                    '150' => 2700,
                    '190' => 3400,
                    '210' => 3700,
                    '230' => 4000,
                    '260' => 4500,
                    '310' => 5200,
                ]
            ],
            'plano4' => [
                'width' => 39.5,
                'height' => 54.5,
                'hp' => 4800,
                'plano' => [79, 109],
                'prices' => [
                    '120' => 2900,
                    '150' => 3500,
                    '190' => 4400,
                    '210' => 4800,
                    '230' => 5200,
                    '260' => 5800,
                    '310' => 7000,
                    '400' => 8800,
                ]
            ],
            'plano5' => [
                'width' => 36,
                'height' => 39,
                'hp' => 4800,
                'plano' => [79, 109],
                'prices' => [
                    '120' => 2900,
                    '150' => 3500,
                    '190' => 4400,
                    '210' => 4800,
                    '230' => 5200,
                    '260' => 5800,
                    '310' => 7000,
                    '400' => 8800,
                ]
            ],
            'plano6' => [
                'width' => 35,
                'height' => 44,
                'hp' => 4800,
                'plano' => [79, 109],
                'prices' => [
                    '120' => 2900,
                    '150' => 3500,
                    '190' => 4400,
                    '210' => 4800,
                    '230' => 5200,
                    '260' => 5800,
                    '310' => 7000,
                    '400' => 8800,
                ]
            ]
        ];

        $ukuran = $request->ukuran;
        $gramasi = $request->gramasi;
        $jumlahCetak = $request->jumlah;
        $laminasi = $request->laminasi;

        $selectedUkuran = $ukuranData[$ukuran];
        $hp = $selectedUkuran['prices'][$gramasi];

        $jumlahPagePerPlano = floor($selectedUkuran['plano'][0] / $selectedUkuran['width']) * floor($selectedUkuran['plano'][1] / $selectedUkuran['height']);
        $jumlahPlano = ceil($jumlahCetak / $jumlahPagePerPlano);

        $jsc = $this->calculateJSC($selectedUkuran['width'], $selectedUkuran['height'], $jumlahCetak);
        $harga = ($jumlahPlano * $hp) + $jsc;
        $hargaLaminasi = $this->calculateLaminasiCost($selectedUkuran['width'], $selectedUkuran['height'], $jumlahCetak, $laminasi);

        $totalHarga = $harga + $hargaLaminasi;

        $transaksi = Transaksi::create([
            'user_id' => auth()->user()->id,
            'nomor_pesanan' => random_int(100000, 999999),
            'nama_produk' => 'Brosur',
            'alamat' => auth()->user()->alamat,
            'harga_plano' => $hp,
            'jml_total' => $jumlahCetak,
            'total_harga' => $totalHarga,
            'gramasi' => $gramasi,
            'laminasi' => $laminasi,
        ]);
        $brosur = Brosur::create([
            'transaksi_id' => $transaksi->id,
            'uk_asli' => $request->uk_asli,
            'uk_width' => $request->uk_width,
            'uk_height' => $request->uk_height
        ]);
        // dd($brosur);
        return back()->with('alert', 'Berhasil Tambah Brosur!');
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
