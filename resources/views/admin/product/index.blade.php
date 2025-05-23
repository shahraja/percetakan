@extends('layouts.admin.app')

@section('title', 'Kelola Produk')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Table Katalog produk</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                  <div class="float-right">
                    @include('admin.product.create')
                </div>
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $product)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$product->judul}}</td>
                          {{-- <td><img class="img img-fluid" width="100" src="{{asset('assets/img/'. $product->gambar)}}" alt=""></td> --}}
                          <td><img class="img img-fluid" width="100" src="{{asset('storage/img/'. $product->gambar)}}" alt=""></td>
                          <td>RP.{{$product->harga}}</td>
                          <td>
                            @include('admin.product.edit')
                            <a href="{{ route('admin.product.ukuran', $product->judul) }}" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i> {{ __('Detail') }}</a>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Gambar</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                      </tr>
                      </tfoot>
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