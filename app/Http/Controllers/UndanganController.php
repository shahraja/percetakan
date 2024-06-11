<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Undangan;

class UndanganController extends Controller
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
            'laminasi' => 'required',
            'status' => 'required',
            'uk_asli' => 'required',
            'uk_width' => 'required',
            'uk_height' => 'required'
        ]);

        Undangan::create([
            'nama_produk' => $request->nama_produk,
            'user_id' => $request->user_id,
            'alamat' => $request->alamat,
            'total_harga' => $request->total_harga,
            'harga_plano' => $request->harga_plano,
            'jumlah' => $request->jumlah,
            'gramasi' => $request->gramasi,
            'laminasi' => $request->laminasi,
            'status' => $request->status,
            'uk_asli' => $request->uk_asli,
            'uk_width' => $request->uk_width,
            'uk_height' => $request->uk_height
        ]);
    }
}
