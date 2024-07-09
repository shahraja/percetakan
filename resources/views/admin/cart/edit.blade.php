<!-- Button to trigger modal -->
<button type="button" class="btn btn-success m-1" data-toggle="modal" data-target="#editModal{{$item->id}}">
    <i class="fa fa-edit"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form for editing -->
                <form id="editForm" action="{{route('admin.cart.update', $item->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nomor_pesanan">No Pesanan</label>
                                <input type="text" class="form-control" name="nomor_pesanan" id="nomor_pesanan"
                                    placeholder="Enter item name" required value="{{ $item->nomor_pesanan }}">
                            </div>
                            <div class="form-group">
                                <label for="status">Status</label>
                                {{-- <input type="text" class="form-control" name="status" id="status"
                                    placeholder="Enter item name" disabled value=""> --}}
                                <select class="form-control" name="status" id="status">
                                    <?php
                                    $enum_status = ['Ditolak', 'Diproses', 'Menunggu Pembayaran', 'Telah Dikonfirmasi', 'Selesai'];
                                    ?>
                                    @foreach ($enum_status as $status)
                                        <option value="{{ $status }}"
                                            {{ $item->status == $status ? 'selected' : '' }}>{{ $status }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="total_harga">Total Harga</label>
                                <input type="text" class="form-control" name="total_harga" id="total_harga"
                                    placeholder="Enter item name" required value="{{ $item->total_harga }}">
                            </div>
                            <div class="form-group">
                                <label for="user_id">User</label>
                                <input type="text" class="form-control" name="user_id" id="user_id"
                                    placeholder="Enter item name" value="{{ $item->user->name }}">
                            </div>
                            <div class="form-group">
                                <label for="judul">Nama Produk</label>
                                <input type="text" class="form-control" name="judul" id="judul"
                                    placeholder="Enter item name" value="{{ $item->produk->judul }}">
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" name="alamat" id="alamat"
                                    placeholder="Enter item name" value="{{ $item->alamat }}">
                            </div>
                            <div class="form-group">
                                <label for="harga_plano">Harga Plano</label>
                                <input type="text" class="form-control" name="harga_plano" id="harga_plano"
                                    placeholder="Enter item name" value="{{ $item->harga_plano }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="jml_total">Jumlah Total Cetak</label>
                                <input type="text" class="form-control" name="jml_total" id="jml_total"
                                    placeholder="Enter item name" value="{{ $item->jml_total }}">
                            </div>
                            <div class="form-group">
                                <label for="gramasi">Gramasi</label>
                                <input type="text" class="form-control" name="gramasi" id="gramasi"
                                    placeholder="Enter item name" value="{{ $item->gramasi }}">
                            </div>
                            <div class="form-group">
                                <label for="laminasi">Laminasi</label>
                                <input type="text" class="form-control" name="laminasi" id="laminasi"
                                    placeholder="Enter item name" value="{{ $item->laminasi }}">
                            </div>
                            <div class="form-group">
                                <label for="gambar">gambar</label><br>
                                <img class="img img-fluid object-fit-contain" width="85" height="85"
                                    src="{{ asset('assets/img/logo-1.png') }}" alt="">
                                <input type="file" class="form-control" name="gambar" id="gambar"
                                    placeholder="Enter item name" enabled value="" accept="image/*">
                            </div>
                            <div class="form-group">
                                <label for="metode_pengambilan">Metode Pengambilan</label>
                                {{-- <input type="text" class="form-control" name="metode_pengambilan"
                                    id="metode_pengambilan" placeholder="Enter item name" disabled value=""> --}}
                                <select class="form-control" name="metode_pengambilan" id="metode_pengambilan">
                                    @if ($item->status == 0)
                                        <option value="0" {{ $item->status == 0 ? 'selected' : '' }}>Pick-up
                                        </option>
                                    @else
                                        <option value="1" {{ $item->status == 1 ? 'selected' : '' }}>Delivery
                                        </option>
                                    @endif
                                </select>
                            </div>
                            @isset($item->Buku->halaman)
                                <div class="form-group">
                                    <label for="halaman">Halaman</label>
                                    <input type="text" class="form-control" name="halaman" id="halaman"
                                        placeholder="Enter item name" value="{{ $item->Buku->halaman }}">
                                </div>
                                <div class="form-group">
                                    <label for="uk_asli">Ukuran Asli</label>
                                    <input type="text" class="form-control" name="uk_asli" id="uk_asli"
                                        placeholder="Enter item name" value="{{ $item->Buku->uk_asli }}">
                                </div>
                                <div class="form-group">
                                    <label for="uk_width">Ukuran Width</label>
                                    <input type="text" class="form-control" name="uk_width" id="uk_width"
                                        placeholder="Enter item name" value="{{ $item->Buku->uk_width }}">
                                </div>
                                <div class="form-group">
                                    <label for="uk_height">Ukuran Height</label>
                                    <input type="text" class="form-control" name="uk_height" id="uk_height"
                                        placeholder="Enter item name" value="{{ $item->Buku->uk_height }}">
                                </div>
                                <div class="form-group">
                                    <label for="finishing">Finishing</label>
                                    <input type="text" class="form-control" name="finishing" id="finishing"
                                        placeholder="Enter item name" value="{{ $item->Buku->finishing }}">
                                </div>
                            @endisset

                        </div>
                    </div>

                    <div class="w-100 py-3 d-flex justify-content-end align-items-center">
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                    <!-- Add more input fields for other properties you want to edit -->
                </form>
            </div>
        </div>
    </div>
</div>
