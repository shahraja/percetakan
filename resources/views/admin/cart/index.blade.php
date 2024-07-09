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
                                                <img src="{{ asset('payment/' . $item->gambar) }}" class="object-fit-contain border rounded" width="80" height="80" alt="">
                                                @else
                                                <img src="{{ asset('assets/img/logo-2.png') }}" class="object-fit-contain border rounded" width="80" height="80" alt="">
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
                                                {{-- @isset($item->Buku) --}}
                                                    
                                                @include('admin.cart.edit')
                                                {{-- @endisset --}}
                                                    
                                                <button type="button" class="btn btn-danger m-1"><i class="fa-solid fa-trash"></i></button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @foreach ($bukus as $buku)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$buku->transaksi->nomor_pesanan}}</td>
                          <td>{{$buku->transaksi->user->name}}</td>
                          <td>{{$buku->transaksi->produk->judul}}</td>
                          <td>{{$buku->transaksi->alamat}}</td>
                          <td>{{$buku->transaksi->harga_plano}}</td>
                          <td>{{$buku->transaksi->jml_total}}</td>
                          <td>{{$buku->transaksi->total_harga}}</td>
                          <td>{{$buku->halaman}}</td>
                          <td>{{$buku->transaksi->gramasi}}</td>
                          <td>{{$buku->transaksi->laminasi}}</td>
                          <td>{{$buku->transaksi->gambar}}</td>
                          <td>{{$buku->transaksi->status}}</td>
                          <td>{{$buku->finishing}}</td>
                          <td>{{$buku->uk_asli}}</td>
                          <td>{{$buku->uk_width}}</td>
                          <td>{{$buku->uk_height}}</td>
                        </tr>
                        @endforeach
                        @foreach ($brosurs as $brosur)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$brosur->transaksi->nomor_pesanan}}</td>
                          <td>{{$buku->transaksi->user->name}}</td>
                          <td>{{$brosur->transaksi->produk->judul}}</td>
                          <td>{{$brosur->transaksi->alamat}}</td>
                          <td>{{$brosur->transaksi->harga_plano}}</td>
                          <td>{{$brosur->transaksi->jml_total}}</td>
                          <td>{{$brosur->transaksi->gramasi}}</td>
                          <td>{{$brosur->transaksi->total_harga}}</td>
                          <td>{{$brosur->transaksi->laminasi}}</td>
                          <td>{{$brosur->transaksi->gambar}}</td>
                          <td>{{$brosur->transaksi->status}}</td>
                          <td>{{$brosur->uk_asli}}</td>
                          <td>{{$brosur->uk_width}}</td>
                          <td>{{$brosur->uk_height}}</td>
                        </tr>
                        @endforeach
                        @foreach ($kalenders as $kalender)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$kalender->transaksi->nomor_pesanan}}</td>
                          <td>{{$buku->transaksi->user->name}}</td>
                          <td>{{$kalender->transaksi->produk->judul}}</td>
                          <td>{{$kalender->transaksi->alamat}}</td>
                          <td>{{$kalender->transaksi->harga_plano}}</td>
                          <td>{{$kalender->transaksi->jml_total}}</td>
                          <td>{{$kalender->transaksi->total_harga}}</td>
                          <td>{{$kalender->transaksi->gramasi}}</td>
                          <td>{{$kalender->transaksi->laminasi}}</td>
                          <td>{{$kalender->transaksi->gambar}}</td>
                          <td>{{$kalender->transaksi->status}}</td>
                          <td>{{$kalender->lembar}}</td>
                          <td>{{$kalender->jilid}}</td>
                          <td>{{$kalender->uk_asli}}</td>
                          <td>{{$kalender->uk_width}}</td>
                          <td>{{$kalender->uk_height}}</td>
                        </tr>
                        @endforeach
                        @foreach ($majalahs as $majalah)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$majalah->transaksi->nomor_pesanan}}</td>
                          <td>{{$buku->transaksi->user->name}}</td>
                          <td>{{$majalah->transaksi->produk->judul}}</td>
                          <td>{{$majalah->transaksi->alamat}}</td>
                          <td>{{$majalah->transaksi->harga_plano}}</td>
                          <td>{{$majalah->transaksi->jml_total}}</td>
                          <td>{{$majalah->transaksi->total_harga}}</td>
                          <td>{{$majalah->transaksi->gramasi}}</td>
                          <td>{{$majalah->transaksi->laminasi}}</td>
                          <td>{{$majalah->transaksi->gambar}}</td>
                          <td>{{$majalah->transaksi->status}}</td>
                          <td>{{$majalah->halaman}}</td>
                          <td>{{$majalah->finishing}}</td>
                          <td>{{$majalah->uk_asli}}</td>
                          <td>{{$majalah->uk_width}}</td>
                          <td>{{$majalah->uk_height}}</td>
                        </tr>
                        @endforeach
                        @foreach ($undangans as $undangan)
                        <tr>
                          <td>{{$loop->iteration}}</td>
                          <td>{{$undangan->transaksi->nomor_pesanan}}</td>
                          <td>{{$buku->transaksi->user->name}}</td>
                          <td>{{$undangan->transaksi->produk->judul}}</td>
                          <td>{{$undangan->transaksi->alamat}}</td>
                          <td>{{$undangan->transaksi->harga_plano}}</td>
                          <td>{{$undangan->transaksi->jml_total}}</td>
                          <td>{{$undangan->transaksi->total_harga}}</td>
                          <td>{{$undangan->transaksi->gramasi}}</td>
                          <td>{{$undangan->transaksi->laminasi}}</td>
                          <td>{{$undangan->transaksi->gambar}}</td>
                          <td>{{$undangan->transaksi->status}}</td>
                          <td>{{$undangan->uk_asli}}</td>
                          <td>{{$undangan->uk_width}}</td>
                          <td>{{$undangan->uk_height}}</td>
                        </tr>
                        @endforeach --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <<th>No</th>
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
