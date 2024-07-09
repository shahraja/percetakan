<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Transaksi;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::all();
        return view('admin.payment.index', compact('transaksis'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|max:255',
        ]);

        $transaksi = Transaksi::findOrFail($id);
        $transaksi->update([
            'status' => $request->status,
        ]);

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Edit User!');
        }
    }
}
