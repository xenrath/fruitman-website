@extends('layouts.main')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Bank</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('bank') }}">Bank</a>
            </li>
            <li class="breadcrumb-item active">Detail Bank</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Bank</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-md-8 offset-md-2">
              <table class="table table-bordered">
                <tbody>
                  <tr>
                    <th style="width: 30%">Nama</th>
                    <td>{{ $bank->name }}</td>
                  </tr>
                  <tr>
                    <th>Gambar</th>
                    <td>
                      <img class="img-thumbnail mt-2" src="{{ asset('storage/uploads/' . $bank->image) }}"
                        width="200px">
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </section>
@endsection
