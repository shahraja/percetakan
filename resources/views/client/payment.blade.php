@extends('layouts.client.app')

@section('title', 'Pembayaran')

@section('content')
    <div class="container mb-3">
        <h2 class="my-5">
            <a href="javascript:history.back()" class="btn btn-success bg-utama">
                <i class="fa fa-arrow-left pe-2"></i>
            </a> 
            Keranjang Saya
        </h2>
        <form action="{{route('payment.update',[$transaksi->produk_id, $transaksi->nomor_pesanan, $transaksi->metode_pengambilan])}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            {{-- @dd($transaksi->nomor_pesanan) --}}
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row">
                        <div>
                            <p>Total Pembayaran</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-6" style="max-width: 70px; max-height:70px;">
                                    <img src="{{asset('assets/img/undangan.jpg')}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                                </div>
                                <div class="col-md-6">
                                    <p>Bank Syariah Indonesia</p>
                                    <hr>
                                    <p class="my-0">Nomor Rekening</p>
                                    <h3 class="my-0">1176678647</h3>
                                </div>
                                <div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <p class="fw-bold" style="text-align: right;">RP {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row my-2">
                        <h5>Petunjuk Pembayaran:</h5>
                        <p>1. Pilih metode transfer dengan menggunakan mBanking, Mitra/Agen terdekat</p>
                        <p>2. Masukan Nomor Rekening 1176678647</p>
                        <p>3. Periksa dan pastikan nomor rekening tujuan benar. Pastikan transfer hanyalah Bank Syariah Indonesia, lalu kemudian transfer dengan jumlah nominal tersebut.</p>
                        <p>4. Setelah Anda melakukan transfer, simpan bukti transfer Anda dan unggah bukti transfer untuk verifikasi pembayaran oleh admin</p>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row my-2">
                        <h5>Kirim Bukti Pembayaran</h5>
                        <div class="col-md-5 m-3">
                            <input class="form-control" type="file" name="gambar" id="gambar" accept="image/png, image/gif, image/jpeg" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn btn-success bg-utama col-md-4">Bayar</button>
            </div>
        </form>
    </div>
@endsection