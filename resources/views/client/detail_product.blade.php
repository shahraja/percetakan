@extends('layouts.client.app')

@section('title', 'Detail Produk')

@section('content')
<div class="container">
        <h1 class="my-5">{{$product->judul}}</h1>
        <div class="row">
            <div class="col-md-6">
                <div class="container" style="max-width: 600px; max-height:500px;">
                    <img src="{{asset('assets/img/'. $product->gambar)}}" class="img img-fluid rounded" style="object-fit: cover" width="500" alt="">
                </div>
            </div>
            <div class="col-md-6">
                <p>{{$product->deskripsi}}</p>
                <form action="">
                    <div class="form-group">
                        <label class="form-label" for="jumlah">Jumlah</label>
                        <input class="form-control" name="jumlah" id="jumlah" type="text">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="sisi">Sisi</label>
                        <select name="sisi" id="sisi" class="form-select">
                            <option value=""></option>
                            <option value="2 sisi">2 Sisi</option>
                            <option value="3 sisi">3 Sisi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="ukuran">Ukuran</label>
                        <select name="ukuran" id="ukuran" class="form-select">
                            <option value=""></option>
                            <option value="A4">A4</option>
                            <option value="A5">A5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="kertas">Kertas</label>
                        <select name="kertas" id="kertas" class="form-select">
                            <option value=""></option>
                            <option value="karton">karton</option>
                            <option value="manggis">manggis</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="laminasi">Laminasi</label>
                        <select name="laminasi" id="laminasi" class="form-select">
                            <option value=""></option>
                            <option value="laminasi">Laminasi</option>
                            <option value="tidak laminasi">Tidak Laminasi</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="lipat">Lipat</label>
                        <select name="lipat" id="lipat" class="form-select">
                            <option value=""></option>
                            <option value="lipat 2 sisi">Lipat 2 Sisi</option>
                            <option value="lipat 3 sisi">Lipat 3 Sisi</option>
                        </select>
                    </div>
                    <div class="text-center my-3">
                        <button class="btn btn-primary bg-utama col-md-6" type="submit">Cek Harga</button>
                    </div>
                </form>
            </div>
        </div>
    </div>    
@endsection