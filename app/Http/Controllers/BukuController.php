<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Product;

class BukuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'halaman' => 'required',
                'uk_asli' => 'required',
                'uk_width' => 'required',
                'uk_height' => 'required',
                'finishing' => 'required',
                // 'produk_id' => 'required',
                // 'total_harga' => 'required',
                // 'harga_plano' => 'required',
                // 'jumlah' => 'required',
                // 'gramasi' => 'required',
                // 'laminasi' => 'required',
            ]
        );

        // dd($request->all());

        // Ambil data dari request
        // dd($request->all());
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

        $transaksi = Transaksi::create([
            'user_id' => auth()->user()->id,
            'nomor_pesanan' => random_int(100000, 999999),
            'produk_id' => 2,
            'alamat' => auth()->user()->alamat,
            'harga_plano' => $harga_plano,
            'jml_total' => $jumlah,
            'total_harga' => $total_harga,
            'gramasi' => $gramasi,
            'laminasi' => $laminasi,
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
        return view('client.checkout', compact('transaksi', 'buku', 'products'));
    }

    private function calculateUkuranData($ukuran, $param, $kertas)
    {
        $ukuranData = [
            'A4' => [
                'width' => 21,
                'height' => 28,
                'prices' => [
                    '120' => 2000,
                    '150' => 2300,
                ],
            ],
            'A5' => [
                'width' => 14.8,
                'height' => 21,
                'prices' => [
                    '120' => 2100,
                    '150' => 2450,
                ],
            ],
        ];

        if ($kertas == null) {
            return $ukuranData[$ukuran][$param];
        }
        return intval($ukuranData[$ukuran][$param][$kertas]);
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
        // Hitung harga total berdasarkan logika perhitungan yang ada
        // Anda perlu menyesuaikan ini dengan rumus yang sudah Anda buat di frontend
        $hargaTotal = $this->calculatePriceLogic(
            $halaman,
            $jumlah,
            $this->calculateUkuranData($ukuran, 'width', null),
            $this->calculateUkuranData($ukuran, 'height', null),
            $ukuran,
            $hargaKertas,
            $laminasi,
            $finishing
        );

        return $hargaTotal;
    }

    private function calculatePriceLogic($halaman, $jumlah, $width, $height, $ukuran, $hargaKertas, $laminasi, $finishing)
    {
        $keteren = ceil($halaman / 8);
        $jumlahPagePerPlano = ceil($jumlah / 2);
        $jumlahPlano = $jumlahPagePerPlano * $keteren;

        $jsc = $this->calculateJSC($width, $height, $jumlah);
        $harga = ($jumlahPlano * $hargaKertas) + ($jsc * 2);
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
        } else if ($width <= 14.8 && $height <= 21) {
            return 360000;
        } else {
            return 0;
        }
    }

    private function calculateLaminasiCost($width, $height, $jc, $laminasi)
    {
        // Fungsi perhitungan biaya laminasi
        // Sesuaikan dengan logika dari frontend
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
