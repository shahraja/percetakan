@extends('layouts.admin.app')

@section('content')
<div class="container">
    <h1>Edit About Page</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('admin.about.update', ['id' => $aboutPage->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="image">Image</label>
            <div class="col" style="max-width: 200px;">
                {{-- <img class="img img-fluid" src="{{ asset('assets/about') }}/{{ $aboutPage->image }}" alt=""> --}}
                <img class="img img-fluid" src="{{asset('storage/about/')}}/{{ $aboutPage->image }}" alt="">
            </div>
            <input type="file" name="image" class="form-control">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ $aboutPage->description }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
