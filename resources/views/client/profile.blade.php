@extends('layouts.client.app')

@section('title', 'Tentang')

@section('content')
    <div class="container mb-5">
        <h1>Profile</h1>
        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 me-3">
                    <img 
                        src="{{ Auth::user()->gambar ? asset('uploads/' . Auth::user()->gambar) : asset('assets/img/logo-1.png') }}" 
                        class="img img-fluid border rounded-circle raunded-image"  
                        alt="Profile Photo">
                    <input class="form-control" type="file" name="gambar" id="gambar" accept="image/png, image/gif, image/jpeg">
                </div>
                
                <div class="col-md-8 border rounded p-3 ms-3">
                    <div class="form-group mb-2">
                        <label for="name" class="from-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}" placeholder="Masukan Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_telp" class="from-label">No Telpon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp" value="{{$user->no_telp}}" placeholder="Masukan Nomor Telpon">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="from-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{$user->email}}" placeholder="Masukan Email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="provinsi" class="from-label">Provinsi</label>
                        <input type="text" class="form-control" name="provinsi" id="provinsi" value="{{$user->provinsi}}" placeholder="Masukan Provinsi">
                    </div>
                    <div class="form-group mb-2">
                        <label for="kota" class="from-label">Kota</label>
                        <input type="text" class="form-control" name="kota" id="kota" value="{{$user->kota}}" placeholder="Masukan Kota">
                    </div>
                    <div class="form-group mb-2">
                        <label for="kecamatan" class="from-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan" value="{{$user->kecamatan}}" placeholder="Masukan Kecamatan">
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat" class="from-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat" value="{{$user->alamat}}" placeholder="Masukan Alamat">
                    </div>
                </div>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn btn-success bg-utama col-md-5">Simpan</button>
            </div>
        </form>
    </div>
@endsection