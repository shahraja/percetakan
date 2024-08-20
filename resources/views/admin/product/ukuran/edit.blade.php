<!-- Edit Button -->
<button type="button" class="btn btn-success" data-toggle="modal" data-target="#editModal{{ $ukuran->id }}">
    <i class="fa fa-edit"></i>
</button>

<!-- Edit Modal -->
<div class="modal fade" id="editModal{{ $ukuran->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Ukuran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.product.ukuran.update', $ukuran->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="nama_ukuran">Nama Ukuran</label>
                        <input type="hidden" name="product" value="{{ $product->judul }}">
                        <input type="text" class="form-control" name="nama_ukuran" id="nama_ukuran"
                            value="{{ $ukuran->nama_ukuran }}" required>
                    </div>
                    <button type="submit" class="btn btn-primary mb-4">Update Ukuran</button>
                </form>
                <form action="{{ route('admin.detailUkuran.updateOrCreate') }}" method="POST">
                    @csrf
                    <input type="hidden" name="ukuran_id" value="{{ $ukuran->id }}">
                    @foreach ($ukuran->detail_ukuran as $detail)
                        <div class="form-group">
                            <label for="nama_detail_ukuran">Detail Ukuran</label>
                            <input type="hidden" name="detail_ukuran_id[]" value="{{ $detail->id }}">
                            <input type="text" class="form-control" name="nama_detail_ukuran[]"
                                id="nama_detail_ukuran_{{ $detail->id }}" value="{{ $detail->nama_detail_ukuran }}"
                                required>
                                <a href="{{ route('admin.valueUkuran.value_ukuran', $detail->id) }}" class="btn btn-danger btn-delete">+</a>
                        </div>
                    @endforeach
                    <div id="newDetailUkuranContainer_{{ $ukuran->id }}"></div>
    
                    <!-- Button to add a new input field -->
                    <button type="button" class="btn btn-primary addDetailUkuranButton" data-id="{{ $ukuran->id }}">
                        Add New Detail Ukuran
                    </button>
                    <button type="submit" class="btn btn-primary ">Update Detail Ukuran</button>
                </form>
                {{-- <button type="submit" class="btn btn-primary">Update Ukuran</button> --}}
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.addDetailUkuranButton').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.stopPropagation(); // Prevents multiple event triggers
            var ukuranId = this.getAttribute('data-id');
            var container = document.getElementById('newDetailUkuranContainer_' + ukuranId);

            // Check if a new input field is already present
            if (!container.querySelector('input[name="nama_detail_ukuran[]"]')) {
                // Create a new div element for the new form-group
                var newDiv = document.createElement('div');
                newDiv.classList.add('form-group');

                // Create a label for the new input
                var newLabel = document.createElement('label');
                newLabel.setAttribute('for', 'nama_detail_ukuran');
                newLabel.innerText = 'Detail Ukuran';

                // Create the new input field
                var newInput = document.createElement('input');
                newInput.setAttribute('type', 'text');
                newInput.setAttribute('name', 'nama_detail_ukuran[]');
                newInput.classList.add('form-control');
                newInput.setAttribute('id', 'nama_detail_ukuran');
                newInput.required = true;

                // Append the label and input to the new div
                newDiv.appendChild(newLabel);
                newDiv.appendChild(newInput);

                // Append the new div to the container
                container.appendChild(newDiv);
            }
        });
    });
</script>
