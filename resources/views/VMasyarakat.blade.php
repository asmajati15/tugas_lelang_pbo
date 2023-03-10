@extends('Layouts')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mx-auto mt-5">
          <div class="card-header">
            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#AddModal">
                Create Query
            </button>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Telepon</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($masyarakat as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama_lengkap}}</td>
                    <td>{{$item->username}}</td>
                    <td>{{$item->telp}}</td>
                    <td>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-url="{{ route('masyarakat.update',['masyarakat'=>$item->id_user]) }}" data-nama_lengkap="{{ $item->nama_lengkap }}" data-username="{{ $item->username }}" data-password="{{ $item->password }}" data-telp="{{ $item->telp }}">Update</a>
                        <form action="{{ route('masyarakat.destroy',['masyarakat'=>$item->id_user]) }}" method="post" class="d-inline-block">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('masyarakat.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Masyarakat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" name="username"  value="{{ old('username') }}">
                        @error('username')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"  value="{{ old('password') }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Telepon</label>
                        <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp"  value="{{ old('telp') }}">
                        @error('telp')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <input type="submit" class="btn blue-800" name="save" value="Submit">
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="modal fade" id="UpdateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="modal-content">
        </div>
    </div>
  </div>
@endsection

@section('js')
<script>
  $('#UpdateModal').on('shown.bs.modal', function(e) {
    var html = `
        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Masyarakat</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="${$(e.relatedTarget).data('url')}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" value="${$(e.relatedTarget).data('nama_lengkap')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" name="username" value="${$(e.relatedTarget).data('username')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Lengkap</label>
                    <input type="text" name="telp" value="${$(e.relatedTarget).data('telp')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
        `;
    $('#modal-content').html(html);
  });
</script>
@endsection