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
                <p class="desk">{{ $product->deskripsi }}</p>
                <h5 class="py-2">Spesifikasi Produk</h5>
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

            {{-- <div class="form-group row pe-2">
                <label class="form-label col-md-3" for="metode_pengambilan">Metode Pengambilan</label>
                <select name="metode_pengambilan" id="metode_pengambilan" class="form-select col-md-9">
                    <option value=""></option>
                    <option value="delivery">Delivery</option>
                    <option value="pickup">Pick Up</option>
                </select>
            </div> --}}

            <label>
                <input type="radio" name="request_desain" value="request_desain" id="request_desain"> Request Desain
            </label>
            <label class="ms-5">
                <input type="radio" name="request_desain" value="no_request" id="request_desain"> Tidak Request
            </label>

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
        </form>
    </div>


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
        // document.addEventListener('DOMContentLoaded', function() {
        //     // Fetch Provinces
        //     fetch('/provinsi')
        //         .then(response => response.json())
        //         .then(data => {
        //             let provinces = data.data.rajaongkir.results;
        //             provinces.forEach(province => {
        //                 let option = document.createElement('option');
        //                 option.value = province.province_id;
        //                 option.textContent = province.province;
        //                 document.getElementById('province').appendChild(option);
        //             });
        //         });

        //     // Fetch Cities based on selected province
        //     document.getElementById('province').addEventListener('change', function() {
        //         let province_id = this.value;
        //         let citySelect = document.getElementById('city');
        //         citySelect.innerHTML = '<option value="">Select City</option>';

        //         if (province_id) {
        //             fetch(`/kota-${province_id}`)
        //                 .then(response => response.json())
        //                 .then(data => {
        //                     let cities = data.data.rajaongkir.results;
        //                     cities.forEach(city => {
        //                         let option = document.createElement('option');
        //                         option.value = city.city_id;
        //                         option.textContent = city.city_name;
        //                         citySelect.appendChild(option);
        //                     });
        //                 });
        //         }
        //     });

        //     // Calculate Cost
        //     document.getElementById('calculateCost').addEventListener('click', function() {
        //         let origin = 501; // Example origin city ID, you can change as needed
        //         let destination = document.getElementById('city').value;
        //         let weight = document.getElementById('weight').value;
        //         let courier = document.getElementById('courier').value;

        //         if (destination && weight && courier) {
        //             let url =
        //                 `/ongkir?origin=${origin}&destination=${destination}&weight=${weight}&courier=${courier}`;
        //             fetch(url)
        //                 .then(response => response.json())
        //                 .then(data => {
        //                     let costs = data.data.rajaongkir.results[0].costs;
        //                     let costInfo = '';
        //                     costs.forEach(cost => {
        //                         costInfo +=
        //                             `<p>Service: ${cost.service} - Cost: ${cost.cost[0].value} - Estimated Delivery Time: ${cost.cost[0].etd} days</p>`;
        //                     });
        //                     document.getElementById('cost').innerHTML = costInfo;
        //                 });
        //         } else {
        //             alert('Please select city, enter weight, and select courier');
        //         }
        //     });
        // });
    </script>

@endsection
