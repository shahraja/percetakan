<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Majalah;

class MajalahController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required',
            'user_id' => 'required',
            'alamat' => 'required|max:255',
            'total_harga' => 'required',
            'harga_plano' => 'required',
            'jumlah' => 'required',
            'gramasi' => 'required',
            'status' => 'required',
            'halaman' => 'required',
            'laminasi' => 'required',
            'uk_asli' => 'required',
            'uk_width' => 'required',
            'uk_height' => 'required',
        ]);

        // Ambil data dari request
        $nama_produk = $request->nama_produk;
        $user_id = $request->user_id;
        $alamat = $request->alamat;
        $total_harga = $this->calculateTotalPrice($request); // Hitung total harga menggunakan fungsi baru
        $harga_plano = $request->harga_plano;
        $jumlah = $request->jumlah;
        $gramasi = $request->gramasi;
        $status = $request->status;
        $halaman = $request->halaman;
        $laminasi = $request->laminasi;
        $uk_asli = $request->uk_asli;
        $uk_width = $request->uk_width;
        $uk_height = $request->uk_height;

        // Simpan ke database
        Majalah::create([
            'nama_produk' => $nama_produk,
            'user_id' => $user_id,
            'alamat' => $alamat,
            'total_harga' => $total_harga,
            'harga_plano' => $harga_plano,
            'jumlah' => $jumlah,
            'gramasi' => $gramasi,
            'status' => $status,
            'halaman' => $halaman,
            'laminasi' => $laminasi,
            'uk_asli' => $uk_asli,
            'uk_width' => $uk_width,
            'uk_height' => $uk_height,
        ]);

        return back()->with('alert', 'Berhasil Tambah Majalah!');
    }

    private function calculateTotalPrice(Request $request)
    {
        // Ambil data dari request
        $halaman = $request->halaman;
        $jumlah = $request->jumlah;
        $ukuran = $request->ukuran;
        $kertas = $request->kertas;
        $laminasi = $request->laminasi;
        $finishing = $request->finishing;

        // Ambil data ukuran dan kertas dari frontend
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

        // Hitung harga kertas berdasarkan pilihan
        $hargaKertas = $ukuranData[$ukuran]['prices'][$kertas];

        // Hitung harga total berdasarkan logika perhitungan yang ada
        // Anda perlu menyesuaikan ini dengan rumus yang sudah Anda buat di frontend
        $hargaTotal = $this->calculatePriceLogic($halaman, $jumlah, $ukuranData[$ukuran]['width'], $ukuranData[$ukuran]['height'], $hargaKertas, $laminasi, $finishing);

        return $hargaTotal;
    }

    private function calculatePriceLogic($halaman, $jumlah, $width, $height, $hargaKertas, $laminasi, $finishing)
    {
        // Implementasi logika perhitungan harga berdasarkan rumus yang telah Anda buat di frontend
        // Misalnya, Anda bisa menggunakan fungsi calculateJSC dan calculateLaminasiCost dari frontend
        $jsc = $this->calculateJSC($width, $height, $jumlah);
        $hargaLaminasi = $this->calculateLaminasiCost($width, $height, $jumlah, $laminasi);

        // Contoh tambahan logika untuk finishing
        $hargaFinishing = 0;
        if ($finishing === 'steples') {
            $hargaFinishing = $jumlah * 1000;
        } elseif ($finishing === 'binding') {
            $hargaFinishing = $jumlah * 2000;
        }

        // Hitung harga total
        $hargaTotal = ($jumlah * $hargaKertas) + $jsc + $hargaLaminasi + $hargaFinishing;

        return $hargaTotal;
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
