@extends('layouts.client.app')

@section('title', 'Tentang')

@section('content')
    <img src="{{asset('assets/img/anesh_printing_1.png')}}" class="shadow" width="100%" alt="">
    <div class="container">
        <h1 class="my-5">Profile Perusahaan</h1>
        <div class="row">
            <div class="col-md-6 mb-5">
                <div class="container" style="max-width: 600px; max-height:500px;">
                    <img src="{{asset('assets/img/anesh_printing_2.png')}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Soluta, rem dolorem? Fugiat corrupti alias eum quas debitis suscipit nostrum in labore ut impedit assumenda quis, molestiae tenetur cupiditate harum nihil.</p>
            </div>
        </div>
    </div> 
@endsection