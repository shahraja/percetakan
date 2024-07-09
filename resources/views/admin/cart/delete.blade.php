<!-- Button to trigger modal -->
<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{$item->id}}">
    <i class="fa fa-trash"></i>
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="deleteModal{{$item->id}}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">Apakah anda yakin ingin menghapus data
                Data?</div>
            <div class="modal-footer">
                <form action="{{ route('admin.cart.destroy', $item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <input type="submit" class="btn btn-danger light" name="" id="" value="Hapus">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">{{ __('Tidak') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
