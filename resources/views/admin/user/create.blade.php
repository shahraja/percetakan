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
          <form id="createForm" action="{{route('admin.user.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="Masukan Nama" required>
            </div>
            <div class="form-group">
              <label for="email">email</label>
              <input type="email" class="form-control" name="email" id="email" placeholder="Masukan Email" >
            </div>
            <div class="form-group">
              <label for="password">Password</label>
              <input type="password" class="form-control" name="password" id="password" placeholder="Masukan password">
            </div>
            <div class="form-group">
              <label for="role">role</label>
              <select class="form-control" name="role" id="role">
                @foreach ($roles as $role)
                <option value="{{$role['id']}}">{{$role['name']}}</option>
                @endforeach
              </select>
            </div>
            <!-- Add more input fields for other properties you want to create -->
            <button type="submit" class="btn btn-primary">Save changes</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  