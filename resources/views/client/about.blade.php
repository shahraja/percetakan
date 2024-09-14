@extends('layouts.client.app')

@section('title', 'Tentang')

@section('content')
    <img src="{{asset('assets/img/anesh_printing_1.png')}}" class="shadow" width="100%" alt="">
    @if($aboutPage = \App\Models\AboutPage::first())
        <img src="{{ asset('assets/about/' . $aboutPage->image_1) }}" class="shadow" width="100%" alt="">
        <div class="container">
            <h1 class="my-5">Profile Perusahaan</h1>
            <div class="row">
                <div class="col-md-6 mb-5">
                    <div class="container" style="max-width: 600px; max-height:500px;">
                        {{-- <img src="{{ asset('assets/about/' . $aboutPage->image) }}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt=""> --}}
                        <img src="{{asset('storage/app/public/about/'. $aboutPage->image)}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                    </div>
                </div>
                <div class="col-md-6 desk">
                    <p>{{ $aboutPage->description }}</p>
                </div>
            </div>
        </div> 
    @endif
@endsection