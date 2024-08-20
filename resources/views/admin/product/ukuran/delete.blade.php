
  <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal{{ $ukuran->id }}">
    <i class="fa fa-trash"></i>
</button>


<!-- Delete Modal -->
<div class="modal fade" id="deleteModal{{ $ukuran->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Delete Ukuran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this ukuran?</p>
            </div>
            <div class="modal-footer">
                <form action="{{ route('admin.product.ukuran.delete', $ukuran->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
