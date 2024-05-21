@extends('layouts.client.app')

@section('title', 'Keranjang Saya')

@section('content')
    <div class="container mb-5">
        <button class="btn btn-success bg-utama"><i class="fa fa-arrow-left pe-2"></i></button><h2 class="my-5">Keranjang Saya</h2>
        <form action="">
            <div class="row my-5">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col text-end">
                                <p>SPXID03623984165C</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col text-end">
                                <p>Pesanan Anda Sedang Dikirim</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="container" style="max-width: 90px; max-height:90px;">
                                        <img src="{{asset('assets/img/undangan.jpg')}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9 mb-1">
                                    <p style="text-align: justify">Banner</p>
                                    <p>variasi: 1 Sisi, Artpaper 100gr, glossy 1 sisi, tanpa lipat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <p>Total Pesanan:</p>
                            <p>RP600.000</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row my-5">
                <div class="border rounded p-3 me-5 shadow">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="col text-end">
                                <p>SPXID03623984165C</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="col text-end">
                                <p>Pesanan Anda Sedang Dikirim</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row py-3">
                                <div class="col-md-3">
                                    <div class="container" style="max-width: 90px; max-height:90px;">
                                        <img src="{{asset('assets/img/undangan.jpg')}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                                    </div>
                                </div>
                                <div class="col-md-9 mb-1">
                                    <p style="text-align: justify">Banner</p>
                                    <p>variasi: 1 Sisi, Artpaper 100gr, glossy 1 sisi, tanpa lipat</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <p>Total Pesanan:</p>
                            <p>RP600.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function(){
          $("#plus-btn").click(function(){
            var currentValue = parseInt($("#quantity-input").val());
            $("#quantity-input").val(currentValue + 1);
          });
          
          $("#minus-btn").click(function(){
            var currentValue = parseInt($("#quantity-input").val());
            if(currentValue > 1) {
              $("#quantity-input").val(currentValue - 1);
            }
          });
        });
      </script>
@endsection