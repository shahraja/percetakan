@extends('layouts.client.app')

@section('title', 'Beranda')

@section('content')
    <img src="{{asset('assets/img/anesh_printing_1.png')}}" class="shadow bg-gradient" width="100%" alt="">
    <div class="container px-0 mb-4" >
        <h2 class="text-center p-4">Produk Kami</h2>
        <div class="row justify-content-center text-center">
            @foreach ($products as $index => $product)
                @if ($index % 3 == 0 && $index != 0)
                    </div><div class="row justify-content-center text-center">
                @endif
                <div class="col-3 p-3 text-center">
                    <a href="{{ route('detail_product', $product->id) }}">
                        <img src="{{ asset('assets/img/' . $product->gambar) }}" class="img img-fluid rounded" style="object-fit: cover" width="200" alt="">
                        <p class="text-center text-black">{{ $product->judul }}</p>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="mb-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.674103176736!2d105.2630356142678!3d-5.395348055272299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d81584c1a8142d%3A0x3b83c6fb7a64d405!2sJl.%20Teuku%20Umar%20No.2%2C%20Pasir%20Gintung%2C%20Kec.%20Tj.%20Karang%20Pusat%2C%20Kota%20Bandar%20Lampung%2C%20Lampung%2035121%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1647859816035!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

@endsection