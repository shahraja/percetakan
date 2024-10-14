<!-- Button to trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
    <i class="fa fa-plus"></i> Tambah Data Akun
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel">Tambah User</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- Form for createing -->
          <form id="createForm" action="{{route('admin.product.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="judul">Judul</label>
              <input type="text" class="form-control" name="judul" id="judul" placeholder="Masukan Judul" required>
            </div>
            <div class="form-group">
              <label for="gambar">Gambar</label>
              <input type="file" class="form-control" name="gambar" id="gambar"
                            placeholder="Enter item name" enabled>
            </div>
            <div class="form-group">
              <label for="harga">Harga</label>
              <input type="harga" class="form-control" name="harga" id="harga" placeholder="Masukan Harga">
            </div>
            <div class="form-group">
              <label for="deskripsi">Deskripsi</label>
              <input type="deskripsi" class="form-control" name="deskripsi" id="deskripsi" placeholder="Masukan Deskripsi">
            </div>
            <!-- Add more input fields for other properties you want to create -->
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  