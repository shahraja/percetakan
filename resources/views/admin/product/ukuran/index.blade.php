@extends('layouts.admin.app')

@section('title', 'Kelola Ukuran')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Table Ukuran</h3>
                        <div class="float-right">
                            @include('admin.product.ukuran.create')
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <th>ID</th>
                                    <th>Product ID</th>
                                    <th>Nama Ukuran</th>
                                    <th>Actions</th>
                                </thead>
                                <tbody>
                                    @foreach ($ukurans as $ukuran)
                                        <tr>
                                            <td>{{ $ukuran->id }}</td>
                                            <td>{{ $ukuran->product_id }}</td>
                                            <td>{{ $ukuran->nama_ukuran }}</td>
                                            <td>
                                                @include('admin.product.ukuran.edit')
                                                @include('admin.product.ukuran.delete')
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection
