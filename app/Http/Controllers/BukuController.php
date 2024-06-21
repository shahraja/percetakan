<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama_produk' => 'required', 
                'user_id' => 'required', 
                'alamat' => 'required|max:255', 
                'total_harga' => 'required', 
                'harga_plano' => 'required', 
                'jumlah' => 'required', 
                'gramasi' => 'required', 
                'status' => 'required', 
                'halaman' => 'required', 
                'finishing' => 'required', 
                'laminasi' => 'required', 
                'uk_asli' => 'required', 
                'uk_width' => 'required', 
                'uk_height' => 'required'
            ]
            );

        Buku::create([
            'nama_produk' => $request->nama_produk,
            'user_id' => $request->user_id,
            'alamat' => $request->alamat,
            'total_harga' => $request->total_harga,
            'harga_plano' => $request->harga_plano,
            'jumlah' => $request->jumlah,
            'gramasi' => $request->gramasi,
            'status' => $request->status,
            'halaman' => $request->halaman,
            'finishing' => $request->finishing,
            'laminasi' => $request->laminasi,
            'uk_asli' => $request->uk_asli,
            'uk_width' => $request->uk_width,
            'uk_height' => $request->uk_height
        ]);
        return back()->with('alert', 'Berhasil Tambah Buku!');
    }
}
