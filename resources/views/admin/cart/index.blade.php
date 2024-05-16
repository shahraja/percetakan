@extends('layouts.admin.app')

@section('title', 'Kelola Pesanan')

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
                        <th>No Pesanan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nama Produk</th>
                        <th>Sisi</th>
                        <th>Ukuran</th>
                        <th>Jumlah Total</th>
                        <th>Lipat</th>
                        <th>Harga</th>
                        <th>Laminasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($carts as $cart)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$cart->no_pesanan}}</td>
                          <td>{{$cart->nama}}</td>
                          <td>{{$cart->alamat}}</td>
                          <td>{{$cart->nama_produk}}</td>
                          <td>{{$cart->sisi}}</td>
                          <td>{{$cart->ukuran}}</td>
                          <td>{{$cart->jumlah_total}}</td>
                          <td>{{$cart->lipat}}</td>
                          <td>{{$cart->harga}}</td>
                          <td>{{$cart->laminasi}}</td>
                          <td>
                            @if ($cart->status == 'Dibatalkan')
                             <span class="badge badge-danger">{{$cart->status}}</span> 
                            @elseif ($cart->status == 'Diproses')
                             <span class="badge badge-primary">{{$cart->status}}</span> 
                            @elseif ($cart->status == 'Selesai')
                             <span class="badge badge-success">{{$cart->status}}</span> 
                            @elseif ($cart->status == 'Menunggu Konfirmasi')
                             <span class="badge badge-warning">{{$cart->status}}</span> 
                            @endif
                          </td>
                          <td>
                            <div>
                              <form action="{{route('admin.cart.update', $cart->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Diproses">
                                <button class="btn btn-primary my-2" type="submit">Verifikasi</button>
                              </form>
                            </div>
                            <div>
                              <form action="{{route('admin.cart.update', $cart->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Dibatalkan">
                                <button class="btn btn-danger my-2" type="submit">Batalkan</button>
                              </form>
                            </div>
                            <div>
                              <form action="{{route('admin.cart.update', $cart->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="status" value="Selesai">
                                <button class="btn btn-success my-2" type="submit">Pesanan Selesai</button>
                              </form>
                            </div>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                      <tfoot>
                      <tr>
                        <th>No</th>
                        <th>No Pesanan</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Nama Produk</th>
                        <th>Sisi</th>
                        <th>Ukuran</th>
                        <th>Jumlah Total</th>
                        <th>Lipat</th>
                        <th>Harga</th>
                        <th>Laminasi</th>
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