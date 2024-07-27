@extends('layouts.client.app')

@section('title', 'Detail Produk')

@section('style')
    <style>
        swiper-container {
            width: 90%;
            height: 90%;
        }

        swiper-slide {
            text-align: center;
            font-size: 18px;
            background: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        swiper-slide img {
            display: sw </swiper-slidek;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        body {
            background: #000;
            color: #000;
        }

        swiper-container {
            width: 100%;
            height: 300px;
            margin-left: auto;
            margin-right: auto;
        }

        swiper-slide {
            background-size: cover;
            background-position: center;
        }

        .mySwiper {
            height: 80%;
            width: 100%;
        }

        .mySwiper2 {
            height: 20%;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .mySwiper2 swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
        }

        .mySwiper2 .swiper-slide-thumb-active {
            opacity: 1;
        }

        swiper-slide img {
            display: sw </swiper-slidek;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <h1 class="my-5">{{ $product->judul }}</h1>
        <div class="row">
            <div class="col-md-6">
                <div>
                </div>
                @php
                    $images = [
                        'Undangan' => ['undangan-1.jpg', 'undangan-2.jpg', 'undangan-3.jpg'],
                        'Majalah' => ['majalah-1.jpg', 'majalah-2.jpg'],
                        'Brosur' => ['brosur-1.jpg', 'brosur-2.jpg', 'brosur-3.jpg'],
                        'Buku' => ['buku-1.jpg', 'buku-2.jpg'],
                        'Kalender' => ['kalender-1.jpg', 'kalender-2.jpg', 'kalender-3.jpg'],
                    ];
                @endphp

                <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                    thumbs-swiper=".mySwiper2" loop="true" space-between="10" navigation="true">
                    <swiper-slide>
                        <img src="{{ asset('assets/img/' . $product->gambar) }}" />
                    </swiper-slide>
                    @if (isset($images[$product->judul]))
                        @foreach ($images[$product->judul] as $image)
                            <swiper-slide>
                                <img src="{{ asset('assets/img/' . $image) }}" />
                            </swiper-slide>
                        @endforeach
                    @endif
                </swiper-container>

                <swiper-container class="mySwiper2" loop="true" space-between="10" slides-per-view="4" free-mode="true"
                    watch-slides-progress="true">
                    <swiper-slide>
                        <img src="{{ asset('assets/img/' . $product->gambar) }}" />
                    </swiper-slide>
                    @if (isset($images[$product->judul]))
                        @foreach ($images[$product->judul] as $image)
                            <swiper-slide>
                                <img src="{{ asset('assets/img/' . $image) }}" />
                            </swiper-slide>
                        @endforeach
                    @endif
                </swiper-container>
            </div>
            <div class="col-md-6">
                <p>{{ $product->deskripsi }}</p>
            </div>
        </div>
        @if ($product->judul == 'Undangan')
            <form class="row pb-3" action="{{ route('user.undangan.store') }}" method="POST">
            @elseif($product->judul == 'Majalah')
                <form class="row pb-3" action="{{ route('user.majalah.store') }}" method="POST">
                @elseif($product->judul == 'Kalender')
                    <form class="row pb-3" action="{{ route('user.kalender.store') }}" method="POST">
                    @elseif($product->judul == 'Buku')
                        <form class="row pb-3" action="{{ route('user.buku.store') }}" method="POST">
                        @elseif($product->judul == 'Brosur')
                            <form class="row pb-3" action="{{ route('user.brosur.store') }}" method="POST">
        @endif
        @csrf
        <h4 class="py-2">Hitung Harga Cetak Online</h4>
        <div class="col border rounded shadow p-4 mx-2">
            <div class="form-group row pe-2">
                <label class="form-label col-md-3" for="jc">Jumlah</label>
                <input class="form-control col-md-9" name="jumlah" id="jc" type="number" required>
            </div>
            <div class="form-group row pe-2">
                <label class="form-label col-md-3" for="ukuran">Ukuran</label>
                <select name="ukuran" id="ukuran" class="form-select col-md-9">
                    <option value=""></option>
                </select>
            </div>
            <div class="form-group row pe-2">
                <label class="form-label col-md-3" for="kertas">Kertas</label>
                <select name="gramasi" id="kertas" class="form-select col-md-9">
                </select>
            </div>

            @if ($product->judul == 'Kalender')
                <div class="form-group row pe-2">
                    <label class="form-label col-md-3" for="lembar">Jumlah Lembar</label>
                    <input class="form-control col-md-9" name="lembar" id="lembar" type="number" required>
                </div>
                <div class="form-group row pe-2">
                    <label class="form-label col-md-3" for="jilid">Jilid</label>
                    <select name="jilid" id="jilid" class="form-select col-md-9">
                        <option value=""></option>
                        <option value="kaleng">Kaleng</option>
                        <option value="spiral">Spiral</option>
                    </select>
                </div>
            @endif

            @if ($product->judul == 'Buku' || $product->judul == 'Majalah')
                <div class="form-group row pe-2">
                    <label class="form-label col-md-3" for="halaman">Jumlah Lembar</label>
                    <input class="form-control col-md-9" name="halaman" id="halaman" type="number" required>
                </div>
                <div class="form-group row pe-2">
                    <label class="form-label col-md-3" for="finishing">Finishing</label>
                    <select name="finishing" id="finishing" class="form-select col-md-9">
                        <option value=""></option>
                        <option value="staples">Staples</option>
                        <option value="binding">Binding</option>
                    </select>
                </div>
            @endif

            <div class="form-group row pe-2">
                <label class="form-label col-md-3" for="laminasi">Laminasi</label>
                <select name="laminasi" id="laminasi" class="form-select col-md-9">
                    <option value=""></option>
                    <option value="glossy1">Glossy</option>
                    <option value="glossy2">Glossy Bolak-Balik</option>
                    <option value="doff1">Doff</option>
                    <option value="doff2">Doff Bolak-Balik</option>
                </select>
            </div>
            {{-- <label>
                <input type="radio" name="metode_pengambilan" value="0" checked onclick="toggleCard()"> Delivery
            </label>
            <label class="ms-5">
                <input type="radio" name="metode_pengambilan" value="1" onclick="toggleCard()"> Pick Up
            </label> --}}

            <div class="text-center my-3">
                <button class="btn btn-primary bg-utama col-md-6" type="button" onclick="calculatePrice()">Cek
                    Harga</button>
            </div>
        </div>
        <div class="col border rounded shadow p-4 mx-2">
            <table class="table">
                <tbody>
                    <tr>
                        <td><strong>Harga Per buah</strong></td>
                        <td>: </td>
                        <td align="right" id="hp"></td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Pesan</strong></td>
                        <td>: </td>
                        <td align="right" id="jc-hasil"></td>
                    </tr>
                    <tr>
                        <td><strong>Harga Total</strong></td>
                        <td>: </td>
                        <td align="right" id="result"></td>
                    </tr>
                    <input type="hidden" name="uk_asli" id="uk_asli">
                    <input type="hidden" name="uk_width" id="uk_width">
                    <input type="hidden" name="uk_height" id="uk_height">
                    <input type="hidden" name="produk_id" id="produk_id" value="{{ $product->judul }}">
                    <tr>
                        <button class="btn btn-primary bg-utama col-md-6 content-center" type="submit">Check Out</button>
                    </tr>
                </tbody>
            </table>
        </div>
        </form>
    </div>


    @if ($product->judul == 'Undangan')
        <script src="{{ asset('/assets/js/undang.js') }}"></script>
    @elseif($product->judul == 'Majalah')
        <script src="{{ asset('/assets/js/majalah.js') }}"></script>
    @elseif($product->judul == 'Kalender')
        <script src="{{ asset('/assets/js/kalender.js') }}"></script>
    @elseif($product->judul == 'Buku')
        <script src="{{ asset('/assets/js/buku.js') }}"></script>
    @elseif($product->judul == 'Brosur')
        <script src="{{ asset('/assets/js/brosur.js') }}"></script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const numberInput = document.getElementById('jc');

            numberInput.addEventListener('input', function(e) {
                const value = e.target.value;
                if (value && !/^\d*$/.test(value)) {
                    e.target.value = value.replace(/\D/g, '');
                }
            });
        });
    </script>

@endsection
