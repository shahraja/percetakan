@extends('layouts.client.app')

@section('title', 'Beli')

@section('content')
    <div class="container mb-5">
        <h2 class="my-5"><span class="btn btn-success bg-utama"><i class="fa fa-arrow-left pe-2"></i></span> Keranjang Saya
        </h2>
        <form action="">
            <label>
                <input type="radio" name="option" value="1" onclick="toggleCard()"> Delivery
            </label>
            <label class="ms-5">
                <input type="radio" name="option" value="2" onclick="toggleCard()"> Pick Up
            </label>
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow card">
                    <div class="row">
                        <div>
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="container">
                                        <p class="my-1">Rose Sumiyanti</p>
                                        <p>0897888999</p>
                                    </div>
                                </div>
                                <div class="col-md-9 mb-1">
                                    <p class="my-1">Alamat Pengiriman</p>
                                    <p>Jalan kampung durian runtuh, RT 123 RW 405 rumah hijau opah ( didepan banyak tanaman
                                        rose) SUKABUMI, KOTA BANDAR LAMPUNG, LAMPUNG, ID 35122</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-2">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row">
                        <div>
                            <p>Produk Dipesan</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row py-3">
                                <di class="col-md-4">
                                    <div class="row">
                                        <div class="col-md-7">
                                            <img src="{{ asset('assets/img/undangan.jpg') }}" class="img img-fluid rounded"
                                                style="object-fit: cover max-width: 120px; max-height:120px;" width="500"
                                                alt="">
                                        </div>
                                        <div class="col-md-5">
                                            <p class="ms-2">{{ $transaksi->nama_produk }}</p>
                                        </div>
                                    </div>
                                </di>
                                <div class="col-md-2 mb-1">
                                    <p>Variasi</p>
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
                                <div class="col-md-2 mb-1">
                                    <p>Harga Satuan</p>
                                    <p>{{ $transaksi->harga_plano }}</p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p>Jumlah</p>
                                    <p>{{ $transaksi->jml_total }}</p>
                                </div>
                                <div class="col-md-2 mb-1">
                                    <p>Subtotal Produk</p>
                                    <p>Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row d-flex justify-content-end mt-5">
                <div class="col-md-4 p-0">
                    <div class="border rounded p-3 mt-2 shadow w-100 justify-content-end">
                        <p class="summary-item">Subtotal: <span class="float-end">Rp <span
                                    id="subtotal">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></span>
                        </p>
                        <p class="summary-item">Ongkos Kirim: <span class="float-end">Rp<span
                                    id="shipping">50.000</span></span></p>
                        <hr>
                        <p class="summary-total">Total Pembayaran: <span class="float-end">Rp<span
                                    id="total-payment">700.000</span></span></p>
                        <div class="text-center my-3">
                            <a href="{{ route('payment', [$transaksi->nama_produk, $transaksi->nomor_pesanan]) }}"
                                class="btn btn-success bg-utama col-md-8">Bayar</a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script>
        // Remove trailing comma
        document.addEventListener('DOMContentLoaded', function() {
            var p = document.querySelector('.col-md-2.mb-1 p:nth-child(2)');
            p.innerHTML = p.innerHTML.trim().replace(/,\s*$/, '');
        });

        document.addEventListener('DOMContentLoaded', function() {
            // Parse the numbers, removing any dots used for thousands separators
            var subtotal = parseInt(document.getElementById('subtotal').innerText.replace(/\./g, ''));
            var shipping = parseInt(document.getElementById('shipping').innerText.replace(/\./g, ''));

            // Calculate the total payment
            var totalPayment = subtotal + shipping;

            // Format the total payment with dots as thousands separators
            document.getElementById('total-payment').innerText = totalPayment.toLocaleString('id-ID');
        });
    </script>

@endsection
