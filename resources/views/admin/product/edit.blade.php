<!-- Button to trigger modal -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $product->id }}">
    <i class="fa fa-edit"></i>
</button>

<!-- Modal -->
<div class="modal fade" id="editModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
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
                <form id="editForm" action="{{ route('admin.product.update', $product->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="judul">Judul</label>
                        <input type="text" class="form-control" name="judul" id="judul"
                            placeholder="Enter item name" required value="{{ $product->judul }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="kertas">kertas</label>
                        <input type="text" class="form-control" name="kertas" id="kertas"
                            placeholder="Enter item name" disabled value="{{ $product->kertas }}">
                    </div> --}}
                    <div class="form-group">
                        <label for="gambar">gambar</label><br>
                        <img class="img img-fluid" width="100" src="{{ asset('assets/img/' . $product->gambar) }}"
                            alt="">
                        <input type="file" class="form-control" name="gambar" id="gambar"
                            placeholder="Enter item name" enabled value="{{ $product->gambar }}">
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">deskripsi</label>
                        <input type="text" class="form-control" name="deskripsi" id="deskripsi"
                            placeholder="Enter item name" required value="{{ $product->deskripsi }}">
                    </div>
                    {{-- <div class="form-group">
                        <label for="harga">harga</label>
                        <input type="text" class="form-control" name="harga" id="harga"
                            placeholder="Enter item name" disabled value="{{ $product->harga }}">
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="prices">Prices</label>
                        @foreach ($product->sizes as $size)
                            <div class="form-group">
                                <label for="price_{{ $size->id }}">Price for {{ $size->nama_ukuran }}</label>
                                <input type="number" class="form-control" name="prices[{{ $size->id }}]"
                                    id="price_{{ $size->id }}" placeholder="Enter price"
                                    value="{{ $size->prices }}" required>
                            </div>
                        @endforeach
                    </div> --}}
                    {{-- <div class="form-group">
                        <label>Prices</label>
                        @foreach ($product->ukuran as $ukuran)
                            @foreach ($ukuran->detailUkuran as $detailUkuran)
                                @if (!$detailUkuran->is_parent && $detailUkuran->nama_detail_ukuran == 'prices')
                                    @foreach ($detailUkuran->detailValueUkuran as $valueUkuran)
                                        <div class="form-group">
                                            <label for="price_{{ $valueUkuran->id }}">Price ({{ $ukuran->nama_ukuran }}, {{ $valueUkuran->nama_value_ukuran }})</label>
                                            <input type="number" class="form-control" name="prices[{{ $valueUkuran->id }}]" id="price_{{ $valueUkuran->id }}" placeholder="Enter price" value="{{ $valueUkuran->value }}" required>
                                        </div>
                                    @endforeach
                                @endif
                            @endforeach
                        @endforeach
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="sisi">sisi</label>
                        <input type="text" class="form-control" name="sisi" id="sisi"
                            placeholder="Enter item name" disabled value="{{ $product->sisi }}">
                    </div>
                    <div class="form-group">
                        <label for="ukuran">ukuran</label>
                        <input type="text" class="form-control" name="ukuran" id="ukuran"
                            placeholder="Enter item name" disabled value="{{ $product->ukuran }}">
                    </div> --}}
                    <!-- Add more input fields for other properties you want to edit -->
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
