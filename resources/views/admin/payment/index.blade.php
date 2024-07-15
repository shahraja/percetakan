@extends('layouts.admin.app')

@section('title', 'Kelola Pembayaran')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Table Pembayaran Masuk</h3>
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
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($transaksis as $transaksi)
                            <tr>
                                <td>{{$loop->iteration}}</td>
                                <td>{{$transaksi->nomor_pesanan}}</td>
                                <td>{{$transaksi->created_at->format('d-m-Y')}}</td>
                                <td>{{$transaksi->user->name}}</td>
                                <td>{{$transaksi->produk->judul}}</td>
                                <td>{{$transaksi->created_at->format('H:i')}}</td>
                                <td><img class="img img-fluid" width="100" src="{{asset('assets/img/'. $transaksi->gambar)}}" alt=""></td>
                                <td>
                                  @if ($transaksi->status == 'Ditolak')
                                    <span class="badge badge-danger">{{$transaksi->status}}</span>  
                                  @elseif ($transaksi->status == 'Diproses')
                                    <span class="badge badge-success">{{$transaksi->status}}</span> 
                                  @elseif ($transaksi->status == 'Menunggu Pembayaran')
                                    <span class="badge badge-warning">{{$transaksi->status}}</span> 
                                  @endif
                                </td>
                                <td>
                                  <div>
                                    <form action="{{route('admin.payment.update', $transaksi->id)}}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" name="status" value="Ditolak">
                                      <button class="btn btn-danger my-2" type="submit">Batalkan</button>
                                    </form>
                                  </div>
                                  <div>
                                    <form action="{{route('admin.payment.update', $transaksi->id)}}" method="POST">
                                      @csrf
                                      @method('PUT')
                                      <input type="hidden" name="status" value="Diproses">
                                      <button class="btn btn-success my-2" type="submit">Pesanan Diverifikasi</button>
                                    </form>
                                  </div>
                                </td>
                              </td>
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
                        <th>Status</th>
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