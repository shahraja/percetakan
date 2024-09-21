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
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $transaksi = Transaksi::with('brosur', 'buku', 'kalender', 'majalah', 'undangan')->latest()->get();
        // dd($transaksi);
        return view('admin.cart.index', compact('transaksi'));
    }

    public function filter(Request $request, $tanggalAwal, $tanggalAkhir)
    {

        $tanggalAwal = Carbon::createFromFormat('Y-m-d', $tanggalAwal);
        $tanggalAkhir = Carbon::createFromFormat('Y-m-d', $tanggalAkhir);

        $transaksi = Transaksi::query()
            ->with('brosur', 'buku', 'kalender', 'majalah', 'undangan', 'user', 'produk')
            ->whereDate('created_at', '>=', $tanggalAwal)
            ->whereDate('created_at', '<=', $tanggalAkhir)
            ->get();

        if ($transaksi->isEmpty()) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        return response()->json(['data' => $transaksi], 200);
    }

    public function edit()
    {
        // $brosurs = Brosur::all();
        // $bukus = Buku::all();
        // $kalenders = Kalender::all();
        // $majalahs = Majalah::all();
        // $undangans = Undangan::all();
        // return view('admin.cart.edit', compact('brosurs', 'bukus', 'kalenders', 'majalahs', 'undangans'));
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
            return back()->with('alert', 'Berhasil Edit!');
        }
    }

    public function destroy(string $id)
    {
        $cart = Transaksi::findOrFail($id);
        $cart->delete();

        if (auth()->user()->role == 'admin') {
            return back()->with('alert', 'Berhasil Hapus!');
        }
    }
}
