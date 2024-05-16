@extends('layouts.admin.app')

@section('title', 'Kelola Pembayaran')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with minimal features & hover style</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>No</th>
                        <th>Token Pesanan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Waktu</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($payments as $payment)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$payment->token_user}}</td>
                                <td>{{$payment->tgl_transaksi}}</td>
                                <td>{{$payment->nama}}</td>
                                <td>{{$payment->produk}}</td>
                                <td>{{$payment->waktu}}</td>
                                <td><img class="img img-fluid" width="100" src="{{asset('assets/img/'. $payment->gambar)}}" alt=""></td>
                            </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>Token Pesanan</th>
                        <th>Tanggal Transaksi</th>
                        <th>Nama</th>
                        <th>Produk</th>
                        <th>Waktu</th>
                        <th>Gambar</th>
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