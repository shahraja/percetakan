@extends('layouts.admin.app')

@section('title', 'Edit Detail Value Ukuran')

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <form action="{{ route('admin.valueUkuran.updateOrCreate', ['id' => $detail_ukuran->id]) }}"
                                method="POST">
                                @csrf

                                <input type="hidden" name="ukuran_id" value="{{ $ukuran->id }}">
                                <input type="hidden" name="detail_ukuran_id" value="{{ $detail_ukuran->id }}">

                                <div id="valueUkuranContainer">
                                    @foreach ($detail_ukuran->detail_value_ukuran as $value)
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="nama_value_ukuran">Value Name</label>
                                                <input type="hidden" name="detail_value_ukuran_id[]"
                                                    value="{{ $value->id }}">
                                                <input type="text" class="form-control" name="nama_value_ukuran[]"
                                                    value="{{ $value->nama_value_ukuran }}" required>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="value">Value</label>
                                                <input type="text" class="form-control" name="value[]"
                                                    value="{{ $value->value }}" required>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-primary" id="addValueUkuranButton">Add New Value
                                    Ukuran</button>
                                <button type="submit" class="btn btn-success">Save</button>
                            </form>
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

    <script>
        document.getElementById('addValueUkuranButton').addEventListener('click', function() {
            var container = document.getElementById('valueUkuranContainer');
            var index = container.children.length / 2; // Each value consists of two fields

            // Create new fields for DetailValueUkuran
            var div = document.createElement('div');
            div.classList.add('form-row');
            div.innerHTML = `
            <div class="form-group col-md-6">
                <label for="nama_value_ukuran_${index}">Value Name</label>
                <input type="hidden" name="detail_value_ukuran_id[]" value="">
                <input type="text" class="form-control" name="nama_value_ukuran[]" id="nama_value_ukuran_${index}" required>
            </div>
            <div class="form-group col-md-6">
                <label for="value_${index}">Value</label>
                <input type="text" class="form-control" name="value[]" id="value_${index}" required>
            </div>
        `;
            container.appendChild(div);
        });
    </script>
@endsection
