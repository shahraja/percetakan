@extends('layouts.client.app')

@section('title', 'Kontak')

@section('content')
    <img src="{{asset('assets/img/anesh_printing_1.png')}}" class="shadow" width="100%" alt="">
    <div class="container">
        <h1 class="my-5">Kontak</h1>
        <div class="col-md-10">
            <h3>Address</h3>
            <p>Jl. Teuku Umar No.2, Pasir Gintung, Kec. Tj. Karang Pusat, Kota Bandar Lampung, Lampung 35121</p>
        </div>
        {{-- <div class="col-md-10">
            <i class="fa-xl fa-solid fa-envelope text-warning"></i>
            <h6>Mail Me</h6>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, rem dolorem? Fugiat corrupti alias eum quas debitis suscipit nostrum in labore ut impedit assumenda quis, molestiae tenetur cupiditate harum nihil.</p>
        </div> --}}
        <div class="col-md-10">
            <i class="fa-xl fa-brands fa-whatsapp text-warning"></i>
            <h5>WhatsApp</h5>
            <p>0821-8213-6011</p>
        </div>
        <div class="col-md-10">
            <i class="fa-xl fa-brands fa-instagram text-warning"></i>
            <h5>Instagram</h5>
            <p>Yogi Grafika Lampung</p>
        </div>
        <div class="col-md-10">
            <i class="fa-xl fa-brands fa-facebook text-warning"></i>
            <h5>Facebook</h5>
            <p>Yogi Grafika</p>
        </div>
    </div>
    <div class="mb-5 d-flex justify-content-center">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3960.674103176736!2d105.2630356142678!3d-5.395348055272299!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d81584c1a8142d%3A0x3b83c6fb7a64d405!2sJl.%20Teuku%20Umar%20No.2%2C%20Pasir%20Gintung%2C%20Kec.%20Tj.%20Karang%20Pusat%2C%20Kota%20Bandar%20Lampung%2C%20Lampung%2035121%2C%20Indonesia!5e0!3m2!1sen!2sus!4v1647859816035!5m2!1sen!2sus" class="rounded" width="95%" height="450" style="border:0; center" allowfullscreen="" loading="lazy"></iframe>
    </div>
@endsection