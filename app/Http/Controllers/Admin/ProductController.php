<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($id);

        $request->validate([
            'judul' => 'required',
            'gambar' => 'mimes:jpg,jpeg,png|max:2048',
            'deskripsi' => 'required',
        ]);

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
        ]);

        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $file_name = time() . '.' . $gambar->getClientOriginalExtension();
            $data->gambar = $file_name;
            $data->update();
            $gambar->move('../public/assets/img/', $file_name);
        }

            return back()->with('alert', 'Berhasil Edit Data!');
    }

}
