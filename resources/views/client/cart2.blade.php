@extends('layouts.client.app')

@section('title', 'Keranjang Saya')

{{-- @dd($bukus) --}}

@section('content')
    <div class="container flex-grow-1 d-flex flex-column">
        <h2 class="my-5">
            <a href="javascript:history.back()" class="btn btn-success bg-utama">
                <i class="fa fa-arrow-left pe-2"></i>
            </a>
            Pesanan Saya
        </h2>
        <form action="">
            @foreach ($transaksis as $transaksi)
                <div class="row my-3">
                    <div class="border rounded p-3 me-5 shadow">
                        {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="col text-end">
                                    <p><b>{{ $transaksi->status }}</b></p>
                                </div>
                            </div>
                            <hr>
                        </div> --}}
                        <div class="progress-bar-wrapper">
                            <ul class="progressbar">
                                <li @class([
                                    'active' =>
                                        $transaksi->status == 'Pesanan Dibuat' ||
                                        $transaksi->status == 'Pembayaran Dikonfirmasi' ||
                                        $transaksi->status == 'Pesanan Diproses' ||
                                        $transaksi->status == 'Pesanan Dikirimkan' ||
                                        $transaksi->status == 'Selesai',
                                ])>
                                    Pesanan Dibuat
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status == 'Pembayaran Dikonfirmasi' ||
                                        $transaksi->status == 'Pesanan Diproses' ||
                                        $transaksi->status == 'Pesanan Dikirimkan' ||
                                        $transaksi->status == 'Selesai',
                                ])>
                                    Pembayaran Dikonfirmasi
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status == 'Pesanan Diproses' ||
                                        $transaksi->status == 'Pesanan Dikirimkan' ||
                                        $transaksi->status == 'Selesai',
                                ])>
                                    Pesanan Diproses
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status == 'Pesanan Dikirimkan' ||
                                        $transaksi->status == 'Selesai',
                                ])>
                                    Pesanan Dikirimkan
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status == 'Selesai',
                                ])>
                                    Selesai
                                </li>
                                {{-- <li @class([
                                    'active' =>
                                        $transaksi->status ==
                                        ('Pesanan Dibuat' ||
                                            'Pembayaran Dikonfirmasi' ||
                                            'Pesanan Diproses' ||
                                            'Pesanan Dikirimkan' ||
                                            'Pesanan Selesai'),
                                ])>
                                    Pesanan Dibuat
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status ==
                                        ('Pembayaran Dikonfirmasi' ||
                                            'Pesanan Diproses' ||
                                            'Pesanan Dikirimkan' ||
                                            'Pesanan Selesai'),
                                ])>
                                    Pesanan Dikonfirmasi
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status ==
                                        ('Pesanan Diproses' || 'Pesanan Dikirimkan' || 'Pesanan Selesai'),
                                ])>
                                    Pesanan Diproses
                                </li>
                                <li @class([
                                    'active' =>
                                        $transaksi->status == ('Pesanan Dikirimkan' || 'Pesanan Selesai'),
                                ])>
                                    Pesanan Dikirimkan
                                </li>
                                <li @class(['active' => $transaksi->status == 'Pesanan Selesai'])>
                                    Pesanan Selesai
                                </li> --}}
                                {{-- <li class="{{ $transaksi->status == 'Pesanan Dibuat' ? 'active' : '' }}">Pesanan Dibuat</li>
                                <li class="{{ $transaksi->status == 'Pembayaran Dikonfirmasi' || $transaksi->status == 'Pesanan Selesai' || $transaksi->status == 'Pesanan Dikirimkan' ? 'active' : '' }}">Pembayaran Dikonfirmasi</li>
                                <li class="{{ $transaksi->status == 'Pesanan Diproses' || $transaksi->status == 'Pesanan Selesai' || $transaksi->status == 'Pesanan Dikirimkan' ? 'active' : '' }}">Pesanan Diproses</li>
                                <li class="{{ $transaksi->status == 'Pesanan Dikirimkan' || $transaksi->status == 'Pesanan Selesai' ? 'active' : '' }}">Pesanan Dikirimkan</li>
                                <li class="{{ $transaksi->status == 'Pesanan Selesai' ? 'active' : '' }}">Pesanan Selesai</li> --}}
                                {{-- <li class="{{ $transaksi->status == 'Pesanan Dibuat' || $transaksi->status != null ? 'active' : '' }}">Pesanan Dibuat <br> {{ $transaksi->created_at }}</li>
                                <li class="{{ $transaksi->status == 'Pembayaran Dikonfirmasi' ? 'active' : '' }}">Pembayaran Dikonfirmasi <br> {{ $transaksi->updated_at }}</li>
                                <li class="{{ $transaksi->status == 'Pesanan Dibuat' ? 'active' : '' }}">Pesanan Dibuat <br> {{ $transaksi->updated_at }}</li>
                                <li class="{{ $transaksi->status == 'Pesanan Dikirimkan' ? 'active' : '' }}">Pesanan Dikirimkan <br> {{ $transaksi->updated_at }}</li>
                                <li class="{{ $transaksi->status == 'Pesanan Selesai' ? 'active' : '' }}">Pesanan Selesai <br> {{ $transaksi->updated_at }}</li> --}}
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="row py-3">
                                    <div class="col-md-2">
                                        <div class="float-end" style="max-width: 90px; max-height:90px;">
                                            <img src="{{ asset('assets/img/undangan.jpg') }}" class="img img-fluid rounded"
                                                style="object-fit: cover" width="500" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-10 mb-1">
                                        <p style="text-align: justify">{{ $transaksi->produk->judul }}</p>
                                        <p>Variasi:
                                            @if ($transaksi->laminasi)
                                                {{ $transaksi->laminasi }},
                                            @endif
                                            @if ($transaksi->harga_plano)
                                                {{ $transaksi->harga_plano }},
                                            @endif
                                            @if ($transaksi->gramasi)
                                                {{ $transaksi->gramasi }},
                                            @endif

                                            {{-- Kalender --}}
                                            @if (isset($kalender))
                                                @if ($kalender->lembar)
                                                    {{ $kalender->lembar }},
                                                @endif
                                                @if ($kalender->jilid)
                                                    {{ $kalender->jilid }},
                                                @endif
                                            @endif

                                            {{-- Undangan --}}
                                            @if (isset($undangan))
                                                @if ($undangan->uk_asli)
                                                    {{ $undangan->uk_asli }},
                                                @endif
                                            @endif

                                            {{-- Brosur --}}
                                            @if (isset($brosur))
                                                @if ($brosur->uk_asli)
                                                    {{ $brosur->uk_asli }},
                                                @endif
                                            @endif

                                            {{-- Buku --}}
                                            @if (isset($buku))
                                                @if ($buku->halaman)
                                                    {{ $buku->halaman }},
                                                @endif
                                                @if ($buku->finishing)
                                                    {{ $buku->finishing }},
                                                @endif
                                            @endif

                                            {{-- Majalah --}}
                                            @if (isset($majalah))
                                                @if ($majalah->halaman)
                                                    {{ $majalah->halaman }},
                                                @endif
                                                @if ($majalah->finishing)
                                                    {{ $majalah->finishing }},
                                                @endif
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <p>Total Pesanan:</p>
                                <p><b>Rp{{ number_format($transaksi->total_harga, 0, ',', '.') }}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
