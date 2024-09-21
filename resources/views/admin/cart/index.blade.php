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

                        <input type="date" name="tanggal-awal" id="tanggal-awal">
                        <input type="date" name="tanggal-akhir" id="tanggal-akhir">
                        <button id="filter-tanggal">
                            <i class="fa-solid fa-search"></i>
                        </button>

                        <div class="table-responsive" style="overflow-x: overlay">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>No Pesanan</th>
                                        <th>Status</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>Total Harga</th>
                                        <th>Request Desain</th>
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
                                <tbody id="table-body">
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}
                                            </td>
                                            <td>{{ $item->nomor_pesanan }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $item->total_harga }}</td>
                                            <td>
                                                @if ($item->request_desain)
                                                    <span class="badge bg-warning">No Request</span>
                                                @else
                                                    <span class="badge bg-success"> Request
                                                    </span>
                                                @endif
                                            </td>
                                            <td>{{ $item->user->name }}</td>
                                            <td>{{ $item->produk->judul }}</td>
                                            <td>{{ $item->alamat }}</td>
                                            <td>{{ $item->harga_plano }}</td>
                                            <td>{{ $item->jml_total }}</td>
                                            <td>{{ $item->gramasi }}</td>
                                            <td>{{ $item->laminasi }}</td>
                                            <td>{{ $item->payment_type }}</td>
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
                                        <th>Request Desain</th>
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
        @pushOnce('scripts')
            <script>
                // ketika tombol filter tanggal di klik
                $('#filter-tanggal').click(function() {

                    // ambil value dari input tanggal awal
                    let tanggalAwal = $('#tanggal-awal').val();
                    
                    // ambil value dari input tanggal akhir
                    let tanggalAkhir = $('#tanggal-akhir').val();

                    // console.log(tanggalAwal, tanggalAkhir);

                    // cek apakah salah satu dari input tanggal kosong
                    if (tanggalAwal === "" || tanggalAkhir === "") {
                        // jika salah satu input tanggal kosong maka tampilkan pesan
                        alert('Tanggal tidak boleh kosong');
                        return;
                    } 

                    // jika tidak kosong maka lakukan request ajax
                    $.ajax({
                        url: `pesanan/filter/${tanggalAwal}/${tanggalAkhir}`,
                        type: "GET",
                        success: function(response) {
                            // console.log(response);
                            // menampilkan data ke table
                            var table = $('#table-body');
                            table.empty();

                            // ketika isi response adalah kosong maka tampilkan pesan
                            if (response.data.length === 0) {
                                table.append(`
                                    <tr>
                                        <td colspan="15" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                `);
                            }

                            response.data.forEach((item, index) => {
                                table.append(`
                                    <tr>
                                        <td>${ index + 1 }</td>
                                        <td>${ item?.nomor_pesanan ?? "-" }</td>
                                        <td>${ item?.status ?? "-" }</td>
                                        <td>${
                                            item?.created_at ? new Date(item.created_at).toLocaleDateString() : "-"
                                            }
                                        </td>
                                        <td>${ item?.total_harga ?? "-" }</td>
                                        <td>
                                            ${
                                                item?.request_desain ? '<span class="badge bg-warning">No Request</span>' : '<span class="badge bg-success"> Request</span>'
                                            }
                                        </td>
                                        
                                        <td>${item?.user?.name ?? "-"}</td>
                                        <td>${ item?.produk?.judul ?? "-" }</td>
                                        <td>${ item?.alamat ?? "-" }</td>
                                        <td>${ item?.harga_plano ?? "-" }</td>
                                        <td>${ item?.jml_total ?? "-" }</td>
                                        <td>${ item?.gramasi ?? "-" }</td>
                                        <td>${ item?.laminasi ?? "-" }</td>
                                        <td>${ item?.payment_type ?? "-" }</td>
                                        <td>
                                            ${
                                                item?.metode_pengambilan ? '<span class="badge bg-success"> Pick Up</span>' : '<span class="badge bg-warning">Delivery</span>'
                                            }
                                        </td>
                                        <td>
                                            @include('admin.cart.edit')
                                            @include('admin.cart.delete')
                                            {{-- <button type="button" class="btn btn-danger m-1"><i class="fa-solid fa-trash"></i></button> --}}
                                        </td>
                                    </tr>
                                `);
                            });
                        
                        },
                        error: function(error) {
                            // jika terjadi error maka refresh halaman
                            var table = $('#table-body');
                            table.empty();

                            table.append(`
                                <tr>
                                    <td colspan="15" class="text-center">Data tidak ditemukan</td>
                                </tr>
                            `);

                            // console.log(error);
                        },
                    })
                });
            </script>
        @endPushOnce
    </section>
    <!-- /.content -->
@endsection
