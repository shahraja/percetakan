@extends('layouts.client.app')

@section('title', 'Keranjang Saya')

{{-- @dd($bukus) --}}

@section('content')
    <div class="container mb-5">
        <h2 class="my-5">
            <span class="btn btn-success bg-utama">
                <a href="#" onclick="history.back();">
                    <p class="text-black"><i class="fas fa-arrow-left fs-4"></i></p>
                </a>
            </span> Keranjang Saya
        </h2>
        <form action="">
            @foreach ($bukus as $buku)
            @if(auth()->user()->id == $buku->transaksi->user_id)
                <div class="row my-5">
                    <div class="border rounded p-3 me-5 shadow">
                        <div class="row">
                            {{-- <div class="col-md-9">
                                <div class="col text-end">
                                    <p>SPXID03623984165C</p>
                                </div>
                            </div> --}}
                            <div class="col-md-12">
                                <div class="col text-end">
                                    <p><b>{{$buku->transaksi->status}}</b></p>
                                </div>
                            </div>
                            <hr>
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
                                        <p style="text-align: justify">{{$buku->transaksi->produk->judul}}</p>
                                        <p>variasi: {{$buku->transaksi->harga_plano}}, {{$buku->transaksi->jml_total}}, {{$buku->transaksi->gramasi}}, {{$buku->transaksi->laminasi}}, {{$buku->halaman}}, {{$buku->finishing}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 text-end">
                                <p>Total Pesanan:</p>
                                <p><b>Rp{{$buku->transaksi->total_harga}}</b></p>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @endforeach
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $("#plus-btn").click(function() {
                var currentValue = parseInt($("#quantity-input").val());
                $("#quantity-input").val(currentValue + 1);
            });

            $("#minus-btn").click(function() {
                var currentValue = parseInt($("#quantity-input").val());
                if (currentValue > 1) {
                    $("#quantity-input").val(currentValue - 1);
                }
            });
        });
    </script>
@endsection
