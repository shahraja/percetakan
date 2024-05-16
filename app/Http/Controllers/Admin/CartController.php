<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $carts = Cart::all();
        return view('admin.cart.index', compact('carts'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|max:255',
        ]);

        $cart = Cart::findOrFail($id);
        $cart->update([
            'status' => $request->status,
        ]);

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Edit User!');
        }
    }
}
