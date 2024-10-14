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
        @if (session('alert'))
            <div class="toast align-items-center text-white {{ session('alert') ? 'bg-danger' : 'bg-success' }} show border-0 top-5 end-3 position-absolute"
                role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        {{ session('alert') }}
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        @endif
        <h1 class="my-4">{{ $product->judul }}</h1>
        <div class="row">
            <div class="col-md-6">
                <swiper-container style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="mySwiper"
                    thumbs-swiper=".mySwiper2" loop="true" space-between="10" navigation="true">
                    <swiper-slide>
                        {{-- <img src="{{asset('storage/app/public/img/'. $product->gambar)}}" /> --}}
                        <img src="{{ asset('storage/img/' . $product->gambar) }}" />
                    </swiper-slide>
                    @if (isset($images[$product->judul]))
                        @foreach ($images[$product->judul] as $image)
                            <swiper-slide>
                                {{-- <img src="{{asset('storage/app/public/img/'. $image)}}" /> --}}
                                <img src="{{ asset('storage/img/' . $image) }}" />
                            </swiper-slide>
                        @endforeach
                    @endif
                </swiper-container>

                <swiper-container class="mySwiper2" loop="true" space-between="10" slides-per-view="4" free-mode="true"
                    watch-slides-progress="true">
                    <swiper-slide>
                        {{-- <img src="{{asset('storage/app/public/img/'. $product->gambar)}}" /> --}}
                        <img src="{{ asset('storage/img/' . $product->gambar) }}" />
                    </swiper-slide>
                    @if (isset($images[$product->judul]))
                        @foreach ($images[$product->judul] as $image)
                            <swiper-slide>
                                {{-- <img src="{{asset('storage/app/public/img/'. $image)}}" /> --}}
                                <img src="{{ asset('storage/img/' . $image) }}" />
                            </swiper-slide>
                        @endforeach
                    @endif
                </swiper-container>
            </div>

            {{-- if untuk produk yang tidak dinamis --}}
            @if ($product->judul == 'Undangan' || $product->judul == 'Majalah' || $product->judul == 'Kalender' || $product->judul == 'Brosur' || $product->judul == 'Buku')
            <div class="col-md-6">
                <p class="desk">{{ $product->deskripsi }}</p>
                {{-- <h5 class="py-2">Spesifikasi Produk</h5> --}}
                {{-- @if (isset($deskripsis[$product->judul]))
                    @foreach ($deskripsis[$product->judul] as $deskripsi)
                        <p class="desk">{{ $deskripsi }}</p>
                    @endforeach
                @endif --}}
                <h5 class="py-2"><i class="fa-solid fa-thumbtack"></i> Deskripsi</h5>
                {{-- <div class="desk">
                    <p><i class="fa-solid fa-info"></i> Untuk melakukan pemesanan harap <B>MELENGKAPI DATA</B> diri Anda untuk kebutuhan pemesanan</p>
                    <p class=""><i class="fa-solid fa-info"></i> Untuk perhitungan produk <b>HANYA</b> kalkulasi produk dengan spesifikasi yang diinginkan oleh Anda</p>
                    <p><i class="fa-solid fa-info"></i> Untuk metode pengiriman akan dikalkulasikan ulang sesuai dengan daerah tempat tinggal Anda, ketika Anda telah melakukan Checkout</p>
                    <p><i class="fa-solid fa-info"></i> Requst Desain bisa dilakukan dan akan dikalkulasikan kembali ketika Anda melakukan Checkout, untuk jasa desain yaitu 85.000</p>
                </div> --}}
                <div class="row">
                    <div class="col-6 col-md-12">
                        <div class="desk">
                            <p><i class="fa-solid fa-info"></i> Untuk melakukan pemesanan harap <b>MELENGKAPI DATA</b> diri
                                Anda untuk kebutuhan pemesanan</p>
                            <p class=""><i class="fa-solid fa-info"></i> Untuk perhitungan produk <b>HANYA</b>
                                kalkulasi produk dengan spesifikasi yang diinginkan oleh Anda</p>
                            <p><i class="fa-solid fa-info"></i> Untuk metode pengiriman akan dikalkulasikan ulang sesuai
                                dengan daerah tempat tinggal Anda, ketika Anda telah melakukan Checkout</p>
                            <p><i class="fa-solid fa-info"></i> Requst Desain bisa dilakukan dan akan dikalkulasikan kembali
                                ketika Anda melakukan Checkout, untuk jasa desain yaitu 85.000</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-12">
                        <div class="desk">
                            <h5>Ukuran:</h5>
                            <ul>
                                <li>Merupakan ketebalaan pada kertas</li>
                            </ul>

                            <h5>Jilid:</h5>
                            <ul>
                                <li>Kaleng : Penjepit dengan menggunakan bahan kaleng</li>
                                <li>Spiral : Penjepit dengan spiral melingkar</li>
                            </ul>

                            <h5>Finishing:</h5>
                            <ul>
                                <li>Staples : Merupakan finishing dengan steples, direkomendasikan untuk jumlah halaman yang
                                    sedikit</li>
                                <li>Binding : Merupakan finishing dengan lem, direkomendasikan untuk halaman yang banyak
                                </li>
                            </ul>

                            <h5>Laminasi:</h5>
                            <ul>
                                <li>Glossy : Finishing Kertas Mengkilap 1 Muka</li>
                                <li>Glossy Bolak-Balik : Finishing Kertas Mengkilap 2 Muka</li>
                                <li>Doff : Finishing Kertas Doff 1 Muka</li>
                                <li>Doff Bolak-Balik : Finishing Kertas Mengkilap 2 Muka</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6">
                <p class="desk">{{ $product->deskripsi }}</p>
            </div>
            @endif
        </div>

        @if ($product->judul == 'Undangan' || $product->judul == 'Majalah' || $product->judul == 'Kalender' || $product->judul == 'Brosur' || $product->judul == 'Buku')
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
        <div class="row d-flex">
            <div class="col-md-5 border rounded shadow p-4 mx-2">
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

                <div class="form-group">
                    <label>
                        <input type="radio" name="metode_pengambilan" value="0" id="metode_pengambilan"> Delivery
                    </label>
                    <label class="ms-5">
                        <input type="radio" name="metode_pengambilan" value="1" id="metode_pengambilan"> Pick Up
                    </label>
                </div>

                <div class="form-group">
                    <label>
                        <input type="radio" name="request_desain" value="0" id="request_desain"> Request
                        Desain
                    </label>
                    <label class="ms-5">
                        <input type="radio" name="request_desain" value="1" id="request_desain"> Tidak Request
                    </label>
                </div>

                <div class="text-center my-3">
                    <button class="btn btn-primary bg-utama col-md-6" type="button" onclick="calculatePrice()">Cek
                        Harga</button>
                </div>
            </div>
            <div class="col-md-5 border rounded shadow p-4 mx-2">
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Harga Pelano</strong></td>
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
                        </tr>
                    </tbody>
                </table>
                @auth
                    {{-- <input type="file" class="form-control col-md-9" name="gambar" id="gambar" required> --}}
                    <button class="btn btn-primary bg-utama col-md-8 offset-md-2" type="submit">Check Out</button>
                @endauth
                @guest
                    <div class="alert alert-primary" role="alert">
                        Jika ingin melakukan pemesanan, <a href="{{ route('login') }}" class="alert-link">Login</a> atau <a
                            href="{{ route('register') }}" class="alert-link">Registrasi</a> terlebih dahulu
                    </div>
                @endguest
            </div>
        </div>
        @endif
        </form>
    </div>


    <div id="ukuranData" data-ukuran='@json($ukuranData)'></div>
    @if ($product->judul == 'Undangan')
        <script src="{{ asset('/assets/js/undang.js') }}"></script>
    @elseif($product->judul == 'Majalah')
        <script src="{{ asset('/assets/js/majalah.js') }}"></script>
    @elseif($product->judul == 'Kalender')
        <script src="{{ asset('/assets/js/kalender.js') }}" crossorigin="anonymous"></script>
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

        document.querySelector('.btn-close').addEventListener('click', function() {
            var toastEl = document.querySelector('.toast');
            var toast = new bootstrap.Toast(toastEl);
            toast.hide();
        });
    </script>

@endsection
