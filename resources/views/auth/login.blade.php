<?php
use App\Models\Product;
$products = Product::all();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>percetakan - Login</title>

    {{-- ini buat style --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
</head>
<body class="bg-warning">
    <main class="">
        {{-- @include('layouts.client.navbar') --}}
    <div class="container mb-5 my-5">
        <div class="d-flex justify-content-center">
            <div class="bg-light border rounded shadow col-md-6">
                <div class="container my-3" style="max-height: 180px; max-width: 180px;">
                    <img src="{{asset('assets/img/logo-2.png')}}" class="img img-fluid rounded shadow" style="object-fit: cover" width="500" alt="">
                </div>
                <form action="{{ route('login') }}" method="POST" class="">
                    @csrf
                    <div class="form-group mx-5">   
                        <label class="form-label" for="email">email</label>
                        <input class="form-control @error('email') is-invalid @enderror mb-2" name="email" required autofocus
                            type="text" name="email" id="email" placeholder="email">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group mx-5">
                        <label class="form-label" for="password">password</label>
                        <input class="form-control @error('password') is-invalid @enderror mt-2" name="password" required
                            type="password" id="password" placeholder="password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="text-center my-3">
                        <button class="btn btn-primary bg-utama col-md-6" type="submit">Login</button>
                    </div>
                    <div class="text-center mb-4">
                        <a class="text-warning" href="{{ route('register') }}">Register</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @include('layouts.client.footer') --}}
</main>

{{-- ini script --}}

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
