<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Brosur;
use App\Models\Buku;
use App\Models\Kalender;
use App\Models\Majalah;
use App\Models\Transaksi;
use App\Models\Undangan;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $transaksi = Transaksi::with('brosur', 'buku', 'kalender', 'majalah', 'undangan')->paginate();
        return view('admin.cart.index', compact('transaksi'));
    }

    public function edit()
    {
        $brosurs = Brosur::all();
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|max:255',
        ]);

        $cart = Transaksi::findOrFail($id);
        $cart->update([
            'status' => $request->status,
        ]);

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Edit User!');
        }
    }
}
