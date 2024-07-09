<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaksi;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(string $produk_id, string $nomor_pesanan, string $metode_pengambilan)
    {
        $transaksi = Transaksi::with('produk')
        ->where('nomor_pesanan', $nomor_pesanan)
        ->where('produk_id', $produk_id)->first();
        $transaksi->update(['metode_pengambilan' => $metode_pengambilan]);
        $products = Product::all();
        return view('client.payment', compact('transaksi', 
        'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $produk_id, string $nomor_pesanan, string $metode_pengambilan)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'gambar'=>'file|image|mimes:jpeg,png,jpg|max:5120',
    
            ]);
            // dd($metode_pengambilan);
            $transaksi = Transaksi::where('nomor_pesanan', $nomor_pesanan)
            ->first();
            $gambar = uniqid().'_'.$request->file('gambar')->getClientOriginalName();
            $request->file('gambar')->move('payment', $gambar);
            $transaksi->update([
                'metode_pengambilan' => $metode_pengambilan,
                'status' => 'Diproses',
                'gambar' => $gambar,
            ]);
            // dd($nomor_pesanan);


            DB::commit();
            return redirect()->route('home');
            // dd($request->all(), $produk_id, $nomor_pesanan);
        }catch(\Exception $e){
            DB::rollBack();
            dd($e);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
