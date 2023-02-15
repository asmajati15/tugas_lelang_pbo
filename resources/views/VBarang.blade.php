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
                  <th>Nama Barang</th>
                  <th>Tanggal Berakhir</th>
                  <th>Harga Awal</th>
                  <th>Status Barang</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ($barang as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->nama_barang}}</td>
                    <td>{{$item->tgl}}</td>
                    <td>{{$item->harga_awal}}</td>
                    <td>{{$item->status_barang}}</td>
                    <td>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#UpdateModal" data-url="{{ route('barang.update',['barang'=>$item->id_barang]) }}" data-nama_barang="{{ $item->nama_barang }}" data-deskripsi_barang="{{ $item->deskripsi_barang }}" data-tgl="{{ $item->tgl }}" data-status_barang="{{ $item->status_barang }}" data-harga_awal="{{ $item->harga_awal }}" data-status_barang="{{ $item->status_barang }}">Update</a>
                        <form action="{{ route('barang.destroy',['barang'=>$item->id_barang]) }}" method="post" class="d-inline-block">
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
            <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Barang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error('nama_barang') is-invalid @enderror" name="nama_barang" value="{{ old('nama_barang') }}">
                        @error('nama_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Deskripsi Barang</label>
                        <input type="text" class="form-control @error('deskripsi_barang') is-invalid @enderror" name="deskripsi_barang" value="{{ old('deskripsi_barang') }}">
                        @error('deskripsi_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Tanggal Berakhir</label>
                        <input type="date" class="form-control @error('tgl') is-invalid @enderror" name="tgl"  value="{{ old('tgl') }}">
                        @error('tgl')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Harga Awal</label>
                        <input type="number" class="form-control @error('harga_awal') is-invalid @enderror" name="harga_awal"  value="{{ old('harga_awal') }}">
                        @error('harga_awal')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                        <label class="form-label">Status Barang</label>
                        <select class="form-select @error('status_barang') is-invalid @enderror" name="status_barang">
                          <option selected hidden>--Pilih status barang--</option>
                          <option value="1">Tersedia</option>
                          <option value="2">Terjual</option>
                        </select>
                        @error('status_barang')
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
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit barang</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form action="${$(e.relatedTarget).data('url')}" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama Barang</label>
                    <input type="text" name="nama_barang" value="${$(e.relatedTarget).data('nama_barang')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Deskripsi Barang</label>
                    <input type="text" name="deskripsi_barang" value="${$(e.relatedTarget).data('deskripsi_barang')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Tanggal</label>
                    <input type="text" name="tgl" value="${$(e.relatedTarget).data('tgl')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga Awal</label>
                    <input type="text" name="harga_awal" value="${$(e.relatedTarget).data('harga_awal')}" class="form-control" id="exampleFormControlInput1"
                        placeholder="name@example.com">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Status Barang</label>
                    <select class="form-select @error('status_barang') is-invalid @enderror" name="status_barang">
                          <option selected hidden>--Pilih status barang--</option>
                          <option value="1">Tersedia</option>
                          <option value="2">Terjual</option>
                    </select>
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

  @if(session()->has('success'))
    Swal.fire(
    'Success',
    '{{ session('success') }}',
    'success'
    )
  @endif
</script>
@endsection