@extends('layouts.admin.app')

@section('title', 'Kelola Pesanan')

@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Data Table Pesanan Masuk</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="table-responsive" style="overflow-x: overlay">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pesanan</th>
                                        <th>Status</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Total Harga</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Alamat</th>
                                        <th>Harga Plano</th>
                                        <th>Jumlah Total Cetak</th>
                                        <th>Gramasi</th>
                                        <th>Laminasi</th>
                                        <th>Metode Pembayran</th>
                                        <th>Metode Pengambilan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration + $transaksi->perpage() * ($transaksi->currentpage() - 1) }}
                                            </td>
                                            <td>{{ $item->nomor_pesanan }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{$item->created_at->format('d-m-Y')}}</td>
                                            <td>{{ $item->total_harga }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->produk->judul }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->harga_plano }}</td>
                                            <td>{{ $item->jml_total }}</td>
                                            <td>{{ $item->gramasi }}</td>
                                            <td>{{ $item->laminasi }}</td>
                                            <td>{{$item->payment_type}}</td>
                                            <td>
                                                @if ($item->metode_pengambilan)
                                                    <span class="badge bg-success"> Pick Up
                                                    </span>
                                                @else
                                                    <span class="badge bg-warning">Delivery</span>
                                                @endif
                                            </td>
                                            <td>
                                                @include('admin.cart.edit')
                                                @include('admin.cart.delete')
                                                {{-- <button type="button" class="btn btn-danger m-1"><i class="fa-solid fa-trash"></i></button> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pesanan</th>
                                        <th>Status</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Total Harga</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Alamat</th>
                                        <th>Harga Plano</th>
                                        <th>Jumlah Total Cetak</th>
                                        <th>Gramasi</th>
                                        <th>Laminasi</th>
                                        <th>Metode Pembayran</th>
                                        <th>Metode Pengambilan</th>
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
