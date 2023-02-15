@extends('Layouts')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mx-auto mt-5">
          <div class="card-header">
            Lelang
          </div>
          <div class="card-body">
            <table class="table table-hover">
              <thead>
                <tr>
                  <th>No</th>
                  <th>ID Barang</th>
                  <th>ID User</th>
                  <th>Harga Akhir</th>
                  <th>Status Barang</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($lelang as $item)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$item->id_barang}}</td>
                    <td>{{$item->id_user}}</td>
                    <td>{{$item->harga_akhir}}</td>
                    <td>{{$item->status}}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection