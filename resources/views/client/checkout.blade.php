@extends('layouts.client.app')

@section('title', 'Beli')

@section('content')

    {{-- midtrans --}}

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- @TODO: replace SET_YOUR_CLIENT_KEY_HERE with your client key -->
        <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="SB-Mid-client-V359WuDbL3tWVysH"></script>
        <!-- Note: replace with src="https://app.midtrans.com/snap/snap.js" for Production environment -->
    </head>

    <div class="container mb-5">
        <h2 class="my-5">
            <a href="javascript:history.back()" class="btn btn-success bg-utama">
                <i class="fa fa-arrow-left pe-2"></i>
            </a>
            Keranjang Saya
        </h2>
        {{-- <form action=""> --}}
        <label>
            <input type="radio" name="metode_pengambilan" value="0" checked onclick="toggleCard()"> Delivery
        </label>
        <label class="ms-5">
            <input type="radio" name="metode_pengambilan" value="1" onclick="toggleCard()"> Pick Up
        </label>
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
                    <p class="summary-item" id="shippingCost" style="display: none;">Ongkos Kirim: <span
                            class="float-end">Rp<span id="shipping">50.000</span></span></p>
                    <hr>
                    <p id="paymentLink" class="summary-total">Total Pembayaran: <span class="float-end">Rp<span
                                id="total-payment">700.000</span></span></p>
                    <div class="text-center my-3">
                        <button class="btn btn-success bg-utama col-md-8" id="pay-button">Pay!</button>
                        {{-- <a id="paymentLink" href="{{ route('payment', [$transaksi->produk_id, $transaksi->nomor_pesanan, '0']) }}"
                                class="btn btn-success bg-utama col-md-8">Bayar</a> --}}
                    </div>
                </div>
            </div>
        </div>
        {{-- </form> --}}
    </div>

    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Transaction Successful</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Your transaction was successful!
                </div>
                <div class="modal-footer">
                    <a href="{{ route('home') }}" type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </div>
            </div>
        </div>
    </div>
    @php
        // dd($transaksi->id);
    @endphp

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

        function toggleCard() {
            const deliveryCard = document.getElementById('deliveryCard');
            const deliveryOption = document.querySelector('input[name="metode_pengambilan"]:checked').value;
            const shippingCost = document.getElementById('shippingCost');
            const paymentLink = document.getElementById('paymentLink');

            if (deliveryOption == 0) {
                deliveryCard.style.display = 'block';
                shippingCost.style.display = 'block';
            } else {
                deliveryCard.style.display = 'none';
                shippingCost.style.display = 'none';
            }

            // Update the payment link href
            paymentLink.href = `{{ route('payment', [$transaksi->produk_id, $transaksi->nomor_pesanan, 'ids']) }}`.replace(
                'ids', deliveryOption);

            calculateTotal();
        }

        window.onload = function() {
            toggleCard();
        };


        // midtrans
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
            window.snap.pay('{{ $token }}', {
                onSuccess: function(result) {
                    // Trigger the modal to show on success
                    $('#successModal').modal('show');

                    fetch('{{ route("update.transaction.status") }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            id: '{{ $transaksi->id }}',
                            status: 'Selesai'
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Transaction status updated:', data);
                    })
                    .catch(error => {
                        console.error('Error updating transaction status:', error);
                    });
                },
                onPending: function(result) {
                    /* You may add your own implementation here */

                    alert("wating your payment!");
                    console.log(result);
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    alert("payment failed!");
                    console.log(result);
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            })
            // customer will be redirected after completing payment pop-up
        });
    </script>
@endsection
