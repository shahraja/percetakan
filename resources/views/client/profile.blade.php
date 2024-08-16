@extends('layouts.client.app')

@section('title', 'Tentang')

@section('content')
    <div class="container mb-5">
        <h1>Profile</h1>
        <form action="{{route('profile.update')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 py-3 me-3 d-flex flex-column align-items-center">
                    <img 
                        src="{{ Auth::user()->gambar ? asset('uploads/' . Auth::user()->gambar) : asset('assets/img/logo-1.png') }}" 
                        class=" rounded-circle object-fit-cover" 
                        width="150"
                        height="150" 
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
                        {{-- <select name="finishing" id="finishing" class="form-select col-md-9">
                            <option value="{{$user->provinsi}}">Bali</option>
                            <option value="{{$user->provinsi}}">Bangka Belitung</option>
                            <option value="{{$user->provinsi}}">Banten</option>
                            <option value="{{$user->provinsi}}">Bengkulu</option>
                            <option value="{{$user->provinsi}}">DI Yogyakarta</option>
                            <option value="{{$user->provinsi}}">DKI Jakarta</option>
                            <option value="{{$user->provinsi}}">Gorontalo</option>
                            <option value="{{$user->provinsi}}">Jambi</option>
                            <option value="{{$user->provinsi}}">Jawa Barat</option>
                            <option value="{{$user->provinsi}}">Jawa Tengah</option>
                            <option value="{{$user->provinsi}}">Jawa Timur</option>
                            <option value="{{$user->provinsi}}">Kalimantan Barat</option>
                            <option value="{{$user->provinsi}}">Kalimantan Selatan</option>
                            <option value="{{$user->provinsi}}">Kalimantan Tengah</option>
                            <option value="{{$user->provinsi}}">Kalimantan Timur</option>
                            <option value="{{$user->provinsi}}">Kalimantan Utara</option>
                            <option value="{{$user->provinsi}}">Kepulauan Riau</option>
                            <option value="{{$user->provinsi}}">Lampung</option>
                            <option value="{{$user->provinsi}}">Maluku</option>
                            <option value="{{$user->provinsi}}">Maluku Utara</option>
                            <option value="{{$user->provinsi}}">Nanggroe Aceh Darussalam (NAD)</option>
                            <option value="{{$user->provinsi}}">usa Tenggara Barat (NTB)</option>
                            <option value="{{$user->provinsi}}">usa Tenggara Timur (NTT)</option>
                            <option value="{{$user->provinsi}}">Papua</option>
                            <option value="{{$user->provinsi}}">Papua Barat</option>
                            <option value="{{$user->provinsi}}">Riau</option>
                            <option value="{{$user->provinsi}}">Sulawesi Barat</option>
                            <option value="{{$user->provinsi}}">Sulawesi Selatan</option>
                            <option value="{{$user->provinsi}}">Sulawesi Tengah</option>
                            <option value="{{$user->provinsi}}">Sulawesi Tenggara</option>
                            <option value="{{$user->provinsi}}">Sulawesi Utara</option>
                            <option value="{{$user->provinsi}}">Sumatera Barat</option>
                            <option value="{{$user->provinsi}}">Sumatera Selatan</option>
                            <option value="{{$user->provinsi}}">Sumatera Utara</option>
                        </select> --}}
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