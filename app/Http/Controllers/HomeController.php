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
use App\Services\CreateSnapToken;

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
        // $transaksi = Transaksi::where('user_id', auth()->user()->id)->get();
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

    public function payment(Request $request,  string $nomor_pesanan)
    {
        $transaksi = Transaksi::with('produk')->where('nomor_pesanan', $nomor_pesanan)->first();
        // dd($transaksi);
        $product = $transaksi->produk;
        // dd($products->id);

        $transaction_details = [
            'order_id'      => $transaksi->nomor_pesanan,
            'gross_amount'  => intval($transaksi->total_harga),
        ];
        $items = [
            [
                'id'    => $transaksi->produk_id,
                'quantity'  => 1,
                'price' => intval($transaksi->total_harga),
                'name'  => 'Kalender',
            ]
        ];

        $customer_details = [
            'first_name'          => $transaksi->user->name,
            'email'         => $transaksi->user->email,
            'phone'         => $transaksi->user->no_telp,
            'address'       => $transaksi->user->alamat,
        ];

        $params = [
            'transaction_details'   => $transaction_details,
            'item_details'          => $items,
            'customer_details'      => $customer_details,
        ];
        $snapToken = new CreateSnapToken($params);
        $token = $snapToken->getSnapToken();

        // dd($totalHarga, $params);
        if ($product->judul == 'Buku') {
            $buku = Buku::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'buku', 'products', 'token'));
        }
        else if($product->judul == 'Kalender') {
            $kalender = Kalender::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'kalender', 'products', 'token'));
        }
        else if($product->judul == 'Majalah') {
            $majalah = Majalah::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'majalah', 'products', 'token'));
        }
        else if($product->judul == 'Undangan') {
            $undangan = Undangan::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'undangan', 'products', 'token'));
        }
        else if($product->judul == 'Brosur') {
            $brosur = Brosur::where('transaksi_id', $transaksi->id)->first();
            $products = Product::all();
            return view('client.checkout', compact('transaksi', 'brosur', 'products', 'token'));
        }
    }

    public function profile()
    {
        $products = Product::all();
        return view('client.profile', compact('products'));
    }
}
