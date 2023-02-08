@extends('Layouts')

@section('content')
<div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="card mx-auto mt-5">
          <div class="card-header">
            Masyarakat
            <button class="btn btn-primary ms-auto" data-bs-toggle="modal" data-bs-target="#createData">
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
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#updateModal" data-url="{{ route('masyarakat.update',['masyarakat'=>$item->id_user]) }}" data-nama="{{ $item->nama_lengkap }}">Update</a>
                        <a class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');" href="{{ route('masyarakat.destroy',['masyarakat'=>$item->id_user]) }}">Delete</a>
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
@endsection