<!-- Button to trigger add modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
    Add New Ukuran
</button>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Add New Ukuran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product.ukuran.store', $product->id) }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="nama_ukuran">Nama Ukuran</label>
                        <input type="hidden" name="product" value="{{ $product->judul }}">
                        <input type="text" class="form-control" name="nama_ukuran" id="nama_ukuran"
                            placeholder="Enter Ukuran Name" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Ukuran</button>
                </form>
            </div>
        </div>
    </div>
</div>
