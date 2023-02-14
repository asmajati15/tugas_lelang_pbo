@extends('Layouts')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mx-auto mt-5">
          <div class="card-header">
            Pelelangan
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
                    {{-- <td>{{$item->lelang->harga_akhir}}</td> --}}
                    <td>{{$item->status_barang}}</td>
                    <td>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AddPenawaran">Ajukan</a>
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

  <div class="modal fade" id="AddPenawaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('lelang.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Ajukan Penawaran</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label class="form-label">Harga yang ditawarkan</label>
                        <input type="text" class="form-control @error('harga_akhir') is-invalid @enderror" name="harga_akhir" value="{{ old('harga_akhir') }}">
                        @error('harga_akhir')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    {{-- <div class="row mb-3">
                        <label class="form-label">Deskripsi Barang</label>
                        <input type="text" class="form-control @error('deskripsi_barang') is-invalid @enderror" name="deskripsi_barang" value="{{ old('deskripsi_barang') }}">
                        @error('deskripsi_barang')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div> --}}
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