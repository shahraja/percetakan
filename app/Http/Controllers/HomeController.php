<?php

namespace App\Http\Controllers;

use App\Models\Brosur;
use App\Models\Buku;
use App\Models\Kalender;
use App\Models\Majalah;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\Undangan;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('client.index', compact('products'));
    }

    public function about()
    {
        $products = Product::all();
        return view('client.about', compact('products'));
    }

    public function contact()
    {
        $products = Product::all();
        return view('client.contact', compact('products'));
    }

    public function detail_product(Request $request, $id)
    {
        $products = Product::all();
        $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
        $product = Product::findOrFail($id);

        return view('client.detail_product', compact('product', 'products'));
    }

    public function cart()
    {
        $userId = auth()->user()->id;
        $transaksis = Transaksi::where('user_id', $userId)->where('status', 'Menunggu Pembayaran')->get();

        $products = Product::all();
        return view('client.cart', compact('transaksis', 'products'));
        // dd($transaksi);
        // $products = $transaksi->produk;
        // $brosurs = $transaksi->brosur();
        // $bukus = $transaksi->buku();
        // $kalenders = $transaksi->kalender();
        // $majalahs = $transaksi->majalah();
        // $undangans = $transaksi->undangan();
        // $brosurs = Brosur::all();
        // $bukus = Buku::all();
        // $kalenders = Kalender::all();
        // $majalahs = Majalah::all();
        // $undangans = Undangan::all();
        // return view('client.cart', compact('transaksi', 'products', 'brosurs', 'bukus', 'kalenders', 'majalahs', 'undangans'));
    }

    public function cart2()
    {
        $userId = auth()->user()->id;
        $statuses = ['Ditolak', 'Diproses', 'Telah Dikonfirmasi', 'Selesai'];
        $transaksis = Transaksi::where('user_id', $userId)->whereIn('status', $statuses)->get();

        $products = Product::all();

        // $brosurs = Brosur::all();
        // $bukus = Buku::all();
        // $kalenders = Kalender::all();
        // $majalahs = Majalah::all();
        // $undangans = Undangan::all();
        return view('client.cart2', compact('transaksis', 'products'));
    }

    public function checkout()
    {
        $products = Product::all();
        return view('client.checkout', compact('products'));
    }

    public function paymnet()
    {
        $products = Product::all();
        return view('client.payment', compact('products'));
    }

    public function profile()
    {
        $products = Product::all();
        return view('client.profile', compact('products'));
    }
}
