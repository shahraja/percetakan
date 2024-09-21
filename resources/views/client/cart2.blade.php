@extends('layouts.client.app')

@section('title', 'Keranjang Saya')

{{-- @dd($bukus) --}}
<style>
    .progressbar {
        counter-reset: step;
    display: flex;
    justify-content: space-between;
    list-style-type: none;
    padding: 0;
    margin: 30px 0;
    position: relative;
    }

    .progressbar li {
        position: relative;
    text-align: center;
    flex-grow: 1;
    }

    .progressbar li::before {
        content: counter(step);
        counter-increment: step;
        width: 30px;
        height: 30px;
        border: 2px solid #4caf50;
        display: block;
        text-align: center;
        margin: 0 auto 10px auto;
        border-radius: 50%;
        background-color: white;
    }

    .progressbar li.active::before {
        background-color: #4caf50;
        color: white;
    }

    .progressbar li::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #4caf50;
        top: 15px;
        left: -50%;
        z-index: -1;
    }

    .progressbar li::after {
        background-color: #ddd;
    }

    .progressbar li.active::after {
        background-color: #4caf50;
        /* Warna untuk garis status yang sudah tercapai */
    }

    .progressbar li:first-child::after {
        content: none;
    }

    .progressbar li.active::after {
        background-color: #4caf50;
    }
</style>
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
                        <div class="row">
                            {{-- <div class="col-md-12">
                                <div class="col text-end">
                                    <p><b>{{ $transaksi->status }}</b></p>
                                </div>
                            </div> --}}
                            <div class="progress-bar-wrapper">
                                <ul class="progressbar">
                                    <li @class([
                                        'active' =>
                                            $transaksi->status == 'Pesanan Dibuat' ||
                                            $transaksi->status == 'Pembayaran Dikonfirmasi' ||
                                            $transaksi->status == 'Pesanan Diproses' ||
                                            ($transaksi->status == 'Pesanan Dikirimkan' &&
                                                $transaksi->metode_pengambilan == 0) ||
                                            $transaksi->status == 'Selesai',
                                    ])>
                                        Pesanan Dibuat
                                    </li>
                                    <li @class([
                                        'active' =>
                                            $transaksi->status == 'Pembayaran Dikonfirmasi' ||
                                            $transaksi->status == 'Pesanan Diproses' ||
                                            ($transaksi->status == 'Pesanan Dikirimkan' &&
                                                $transaksi->metode_pengambilan == 0) ||
                                            $transaksi->status == 'Selesai',
                                    ])>
                                        Pembayaran Dikonfirmasi
                                    </li>
                                    <li @class([
                                        'active' =>
                                            $transaksi->status == 'Pesanan Diproses' ||
                                            ($transaksi->status == 'Pesanan Dikirimkan' &&
                                                $transaksi->metode_pengambilan == 0) ||
                                            $transaksi->status == 'Selesai',
                                    ])>
                                        Pesanan Diproses
                                    </li>
    
                                    {{-- Conditional rendering for Pesanan Dikirimkan --}}
                                    @if ($transaksi->metode_pengambilan == 0)
                                        <li @class([
                                            'active' =>
                                                $transaksi->status == 'Pesanan Dikirimkan' ||
                                                $transaksi->status == 'Selesai',
                                        ])>
                                            Pesanan Dikirimkan
                                        </li>
                                    @endif
    
                                    <li @class([
                                        'active' => $transaksi->status == 'Selesai',
                                    ])>
                                        Selesai
                                    </li>
                                </ul>
                            </div>
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
