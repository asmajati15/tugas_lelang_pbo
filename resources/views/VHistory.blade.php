@extends('Layouts')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mx-auto mt-5">
          <div class="card-header">
            <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddPenawaran">Tambah</a>
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Lelang</th>
                  <th>ID User</th>
                  <th>Penawaran Harga</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($history as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->id_lelang}}</td>
                    <td>{{$item->id_user}}</td>
                    <td>{{$item->penawaran_harga}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="AddPenawaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('history.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajukan Penawaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="form-label">Harga yang ditawarkan</label>
                        <input type="text" class="form-control @error('penawaran_harga') is-invalid @enderror" name="penawaran_harga" value="{{ old('penawaran_harga') }}">
                        @error('penawaran_harga')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="row mb-3">
                      <select name="id_lelang" id="" class="form-select">
                          <option value="" selected>Select your lelang</option>
                          @foreach (DB::table('tb_lelang')->get() as $item)
                              <option value="{{ $item->id_lelang }}">{{ $item->id_lelang }}</option>
                          @endforeach
                      </select>
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
@endsection

@section('js')
    <script>
      @if (!is_null(Session::get('message')))
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            Swal.fire({
                position: 'center',
                icon: @json(Session::get('status')),
                title: @json(Session::get('status')),
                html: @json(Session::get('message')),
                showConfirmButton: false,
                timer: 4000
            })
        </script>
    @endif
    </script>
@endsection