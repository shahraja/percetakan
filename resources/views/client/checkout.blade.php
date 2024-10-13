@extends('layouts.client.app')

@section('title', 'Beli')

@section('content')

    {{-- midtrans --}}

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-V359WuDbL3tWVysH"></script>
    </head>

    <div class="container mb-5">
        <h2 class="my-5">
            <a href="javascript:history.back()" class="btn btn-success bg-utama">
                <i class="fa fa-arrow-left pe-2"></i>
            </a>
            Keranjang Saya
        </h2>

        <div class="row my-2">
            <div id="deliveryCard" class="border rounded p-3 me-5 shadow card">
                <div class="row">
                    <div>
                        <div class="row py-3">
                            <div class="col-md-3">
                                <div class="container">
                                    <p class="my-1"><b>{{ $transaksi->user->name }}</b></p>
                                    <p>{{ $transaksi->user->no_telp }}</p>
                                </div>
                            </div>
                            <div class="col-md-9 mb-1">
                                <p class="my-1"><b>Alamat Pengiriman</b></p>
                                <p>{{ $transaksi->user->alamat }}</p>
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
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-7">
                                        <img src="{{ asset('assets/img/undangan.jpg') }}" class="img img-fluid rounded"
                                            style="object-fit: cover; max-width: 120px; max-height:120px;" alt="">
                                    </div>
                                    <div class="col-md-5">
                                        <p class="ms-2">{{ $transaksi->produk->judul }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-2 mb-1">
                                <p>Variasi</p>
                                <p>
                                    {{-- Variasi Produk --}}
                                    @if ($transaksi->laminasi)
                                        {{ $transaksi->laminasi }},
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
                    <p style="font-size: 0.875rem; font-style: italic; color: rgba(0, 0, 0, 0.5);">
                        Transaksi Maksimal 1x24 Jam
                    </p>

                    {{-- Kondisi tampilkan shipping cost jika delivery dipilih --}}
                    @if ($transaksi->metode_pengambilan == 0)
                    <p style="font-size: 0.875rem; font-style: italic; color: rgba(0, 0, 0, 0.5);">
                        Subtotal sudah termasuk Ongkir: Rp {{ number_format($transaksi->shipping_cost, 0, ',', '.') }}
                    </p>
                    @endif

                    {{-- Kondisi tampilkan design jika request_desain dipilih --}}
                    @if ($transaksi->request_desain == 0)
                    <p id="design-notification"
                        style="font-size: 0.875rem; font-style: italic; color: rgba(0, 0, 0, 0.5);">
                        Subtotal sudah termasuk Desain: Rp 85.000
                    </p>
                    @endif

                    <hr>
                    <p id="paymentLink" class="summary-total">Total Pembayaran: <span class="float-end">Rp<span
                                id="total-payment">{{ number_format($transaksi->total_harga, 0, ',', '.') }}</span></span>
                    </p>
                    <div class="text-center my-3">
                        <button class="btn btn-success bg-utama col-md-8" id="pay-button">Pay!</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var p = document.querySelector('.col-md-2.mb-1 p:nth-child(2)');
            p.innerHTML = p.innerHTML.trim().replace(/,\s*$/, '');
        });

        function calculateTotal() {
            var subtotal = parseInt(document.getElementById('subtotal').innerText.replace(/\./g, ''));
            var shippingElement = document.getElementById('shipping');
            var shipping = shippingElement ? parseInt(shippingElement.innerText.replace(/\./g, '')) : 0;
            var deliveryOption = document.querySelector('input[name="metode_pengambilan"]:checked').value;

            if (deliveryOption == 1) {
                shipping = 0; // Set shipping cost to 0 if "Pick Up" is selected
            }

            var totalPayment = subtotal + shipping;
            document.getElementById('total-payment').innerText = totalPayment.toLocaleString('id-ID');
        }

        // midtrans script
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            window.snap.pay('{{ $token }}', {
                onSuccess: function(result) {
                    $('#successModal').modal('show');
                    console.log(result);
                },
                onPending: function(result) {
                    alert("waiting for your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    alert('You closed the popup without finishing the payment');
                }
            });
        });
    </script>

@endsection
