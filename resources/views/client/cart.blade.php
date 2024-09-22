@extends('layouts.client.app')

@section('title', 'Keranjang')

@section('content')
    <div class="container mb-5 flex-grow-1 d-flex flex-column">
        <h2 class="my-5">
            <a href="javascript:history.back()" class="btn btn-success bg-utama">
                <i class="fa fa-arrow-left pe-2"></i>
            </a>
            Keranjang Saya
        </h2>
        <div class="row">
            @foreach ($transaksis as $transaksi)
                {{-- {{ $transaksi->status }} --}}
                <div class="border rounded my-2 p-3 me-5 shadow">
                    <div class="row">
                        <div class="col-md-12 text-end">
                            <form action="{{ route('cart.clear', $transaksi->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger text-end">
                                    Hapus Pesanan
                                    {{ $transaksi->produk ? $transaksi->produk->name : 'Produk tidak ditemukan' }}
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr width="100%" noshade>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="container" style="max-width: 90px; max-height:90px;">
                                        <img src="{{ asset('assets/img/undangan.jpg') }}" class="img img-fluid rounded"
                                            style="object-fit: cover" width="500" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <p>{{ $transaksi->produk->judul }}</p>
                                    <p>Variasi: </p>
                                    <p>
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
                                {{-- <div class="row">
                                        <div class="col-md-3">
                                            <button class="btn btn-outline-secondary btn-sm">Remove</button>  
                                        </div>  
                                    </div> --}}
                            </div>
                            {{-- <hr width="100%" noshade> --}}
                        </div>
                        <div class="col-md-4 text-end pe-5 py-4">
                            <p>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>

                            <p>Total: {{ $transaksi->jml_total }}</p>
                        </div>
                    </div>
                    <hr width="100%" noshade>
                    {{-- <div class=" text-end">
                        <p>Subtotal: {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                        <p>Total: {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                        <div class="text-end my-3">
                            <a id="paymentLink" href="{{ route('payment', [$transaksi->produk_id, $transaksi->nomor_pesanan, '0']) }}"
                                class="btn btn-success bg-utama col-md-3">Bayar</a>
                        </div>
                    </div> --}}
                    <div class="d-flex justify-content-end">
                        <div class="col-md-4 p-0">
                            <div class="border rounded p-3 mt-2 shadow w-100 justify-content-end">
                                <p class="summary-item">Subtotal: <span class="float-end">Rp <span
                                            id="subtotal">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></span>
                                </p>
                                <hr width="100%" noshade>
                                <div class="text-center my-3">
                                    {{-- <a id="paymentLink" href="{{ route('payment', [$transaksi->produk_id, $transaksi->nomor_pesanan, '0']) }}"
                                        class="btn btn-success bg-utama col-md-8">Bayar</a> --}}
                                    <a id="paymentLink" href="{{ route('payment', [$transaksi->nomor_pesanan]) }}"
                                        class="btn btn-success bg-utama col-md-8">Bayar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script></script> --}}
@endsection
