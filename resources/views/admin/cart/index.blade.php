@extends('layouts.admin.app')

@section('title', 'Kelola Pesanan')

@section('content')
    <div id="notification" class="alert alert-info">
        Silakan pilih rentang tanggal terlebih dahulu untuk menampilkan data.
        <div class="form-group">
            <label for="tanggal-awal">Tanggal Awal:</label>
            <input type="date" id="tanggal-awal" class="form-control btn-sm">
        </div>
        <div class="form-group">
            <label for="tanggal-akhir">Tanggal Akhir:</label>
            <input type="date" id="tanggal-akhir" class="form-control btn-sm">
        </div>
        <button id="filter-tanggal" class="btn btn-primary">Filter</button>
        <button id="reset-filter" class="btn btn-secondary">Reset</button>
    </div>
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
                                        <th>Request Desain</th>
                                        <th>User</th>
                                        <th>Nama Produk</th>
                                        <th>Alamat</th>
                                        <th>Harga Plano</th>
                                        <th>Jumlah Total Cetak</th>
                                        <th>Gramasi</th>
                                        <th>Laminasi</th>
                                        <th>Metode Pembayaran</th>
                                        <th>Metode Pengambilan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($transaksi as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nomor_pesanan }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ $item->created_at->format('d-m-Y') }}</td>
                                            <td>{{ $item->total_harga }}</td>
                                            <td>
                                                @if ($item->request_desain)
                                                    <span class="badge bg-warning">No Request</span>
                                                @else
                                                    <span class="badge bg-success">Request</span>
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
                                                    <span class="badge bg-success">Pick Up</span>
                                                @else
                                                    <span class="badge bg-warning">Delivery</span>
                                                @endif
                                            </td>
                                            <td>
                                                @include('admin.cart.edit')
                                                @include('admin.cart.delete')
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
@endsection

@pushOnce('scripts')
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>

    <script>
        $(document).ready(function() {
            var table = $('#example1').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'excelHtml5',
                        text: 'Export Excel',
                        title: 'Data Pesanan',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        text: 'Export CSV',
                        title: 'Data Pesanan',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: 'Export PDF',
                        title: 'Data Pesanan',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    },
                    {
                        extend: 'print',
                        text: 'Print',
                        title: 'Data Pesanan',
                        exportOptions: {
                            columns: ':not(:last-child)'
                        }
                    }
                ]
            });

            // Filter tanggal
            $('#filter-tanggal').click(function() {
                let tanggalAwal = $('#tanggal-awal').val();
                let tanggalAkhir = $('#tanggal-akhir').val();

                if (tanggalAwal === "" || tanggalAkhir === "") {
                    alert('Tanggal tidak boleh kosong');
                    return;
                }

                // Filter berdasarkan kolom tanggal transaksi (index 3)
                $.fn.dataTable.ext.search.push(
                    function(settings, data, dataIndex) {
                        let tanggalTransaksi = data[3]; // Kolom tanggal transaksi
                        let tanggalTransaksiFormatted = new Date(tanggalTransaksi.split('-').reverse()
                            .join('-'));

                        let startDate = new Date(tanggalAwal);
                        let endDate = new Date(tanggalAkhir);

                        return (tanggalTransaksiFormatted >= startDate && tanggalTransaksiFormatted <=
                            endDate);
                    }
                );

                table.draw(); // Menggambar ulang tabel dengan filter
            });

            // Reset filter
            $('#reset-filter').click(function() {
                $.fn.dataTable.ext.search.pop(); // Hapus filter
                table.draw(); // Menggambar ulang tabel
            });
        });
    </script>
@endPushOnce
