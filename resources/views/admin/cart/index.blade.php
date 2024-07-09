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
                                        <th>Status</th>
                                        <th>Total Harga</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Alamat</th>
                                        <th>Harga Plano</th>
                                        <th>Jumlah Total Cetak</th>
                                        <th>Gramasi</th>
                                        <th>Laminasi</th>
                                        <th>Gambar</th>
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
                                            <td>{{ $item->total_harga }}</td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->produk->judul }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->harga_plano }}</td>
                                            <td>{{ $item->jml_total }}</td>
                                            <td>{{ $item->gramasi }}</td>
                                            <td>{{ $item->laminasi }}</td>
                                            <td>
                                                @isset($item->gambar)
                                                    <img src="{{ asset('payment/' . $item->gambar) }}"
                                                        class="object-fit-contain border rounded" width="80" height="80"
                                                        alt="">
                                                @else
                                                    <img src="{{ asset('assets/img/logo-2.png') }}"
                                                        class="object-fit-contain border rounded" width="80" height="80"
                                                        alt="">
                                                @endisset
                                            </td>
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
                                        <th>Total Harga</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Alamat</th>
                                        <th>Harga Plano</th>
                                        <th>Jumlah Total Cetak</th>
                                        <th>Gramasi</th>
                                        <th>Laminasi</th>
                                        <th>Gambar</th>
                                        <th>Metode Pengambilan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </tfoot>
                            </table>
                            @if ($transaksi->hasPages())
                                <div class="pagination-wrapper">
                                    {{ $transaksi->links() }}
                                </div>
                            @endif
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
