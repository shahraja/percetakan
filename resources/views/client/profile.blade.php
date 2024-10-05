@extends('layouts.client.app')

@section('title', 'Tentang')

@section('content')
    <div class="container mb-5">
        <h1>Profile</h1>
        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-3 py-3 me-3 d-flex flex-column align-items-center">
                    <img src="{{ Auth::user()->gambar ? asset('uploads/' . Auth::user()->gambar) : asset('assets/img/logo-1.png') }}"
                        class=" rounded-circle object-fit-cover" width="150" height="150" alt="Profile Photo">
                    <input class="form-control" type="file" name="gambar" id="gambar"
                        accept="image/png, image/gif, image/jpeg">
                </div>

                <div class="col-md-8 border rounded p-3 ms-3">
                    <div class="form-group mb-2">
                        <label for="name" class="from-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}"
                            placeholder="Masukan Name">
                    </div>
                    <div class="form-group mb-2">
                        <label for="no_telp" class="from-label">No Telpon</label>
                        <input type="text" class="form-control" name="no_telp" id="no_telp"
                            value="{{ $user->no_telp }}" placeholder="Masukan Nomor Telpon">
                    </div>
                    <div class="form-group mb-2">
                        <label for="email" class="from-label">Email</label>
                        <input type="text" class="form-control" name="email" id="email" value="{{ $user->email }}"
                            placeholder="Masukan Email">
                    </div>
                    <div class="form-group mb-2">
                        <label for="provinsi" class="from-label">Provinsi</label>
                        <select class="form-control" name="provinsi" id="provinsi">
                            <option value="" disabled selected>Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province['province'] }}" data-value="{{ $province['province_id'] }}"
                                    {{ $province['province'] == $user->provinsi ? 'selected' : '' }}>
                                    {{ $province['province'] }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="kota" class="from-label">Kota</label>
                        <select class="form-control" name="kota" id="kota">
                            <option value="" disabled selected>Pilih Kota</option>
                            @if ($user->kota != null)
                                <option value="{{ $user->kota }}" selected>{{ $user->kota }}</option>
                            @endif
                        </select>
                    </div>
                    <div class="form-group mb-2">
                        <label for="kecamatan" class="from-label">Kecamatan</label>
                        <input type="text" class="form-control" name="kecamatan" id="kecamatan"
                            value="{{ $user->kecamatan }}" placeholder="Masukan Kecamatan">
                    </div>
                    <div class="form-group mb-2">
                        <label for="alamat" class="from-label">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id="alamat"
                            value="{{ $user->alamat }}" placeholder="Masukan Alamat">
                    </div>
                </div>
            </div>
            <div class="text-center my-3">
                <button type="submit" class="btn btn-success bg-utama col-md-5">Simpan</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script>

        const userCity = '{{ $user->kota }}';
        $(document).ready( function() {
            // Ketika provinsi dipilih
            $('#provinsi').on('change', function() {
                let province_id = $(this).find(':selected').data('value');

                // Bersihkan select kota saat provinsi berubah
                $('#kota').html('<option value="" disabled selected>Memuat Kota...</option>');

                if (province_id) {

                    // Lakukan AJAX untuk mendapatkan kota berdasarkan provinsi yang dipilih
                    const response = fetch(`/profile/kota/${province_id}`).then(response => response.json()).then(data => {

                        $('#kota').html('<option value="" disabled selected>Pilih Kota</option>');
                        
                        data.forEach(city => {
                            var cityName = city.city_name;
                            $('#kota').append(`<option ${city.city_id == userCity ? 'selected' : ''} value="${cityName}">${cityName}</option>`);
                        });
                    
                    });

                }
            });
        });
    </script>
@endsection
