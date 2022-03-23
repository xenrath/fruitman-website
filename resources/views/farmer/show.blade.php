@extends('layouts.main')

@section('title', 'Detail Petani')

@section('content')
  <div class="card card-primary">
    <div class="card-header">
      <h3 class="card-title">Detail Petani</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <table class="table table-bordered">
            <tbody>
              <tr>
                <th style="width: 30%">Email</th>
                <td>{{ $farmer->email }}</td>
              </tr>
              <tr>
                <th>Nama</th>
                <td>{{ $farmer->name }}</td>
              </tr>
              <tr>
                <th>Jenis Kelamin</th>
                <td>
                  @if($farmer->gender == "L")
                      Laki-laki
                  @else
                      Perempuan
                  @endif
                </td>
              </tr>
              <tr>
                <th>No. Telepon</th>
                <td>{{ $farmer->phone }}</td>
              </tr>
              <tr>
                <th>Alamat</th>
                <td>{{ $farmer->address }}</td>
              </tr>
              <tr>
                <th>Gambar</th>
                <td>
                  <img class="img-thumbnail mt-2" src="{{ asset('storage/uploads/'.$farmer->image) }}" width="200px">
                </td>
              </tr>
              <tr>
                <th>Dibuat</th>
                <td>{{ $farmer->created_at }}</td>
              </tr>
              <tr>
                <th>Diubah</th>
                <td>{{ $farmer->updated_at }}</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection