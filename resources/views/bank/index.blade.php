@extends('layouts.main')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bank</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">Bank</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      @if (session('status'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-check"></i> {{ session('status') }}
        </div>
      @endif
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Bank</h3>
          <form action="{{ url('bank') }}">
            <div class="form-group-sm">
              <div class="float-right">
                <a href="{{ url('bank/create') }}" class="btn btn-success btn-sm">
                  <i class="fa fa-plus"></i>
                  Tambah
                </a>
              </div>
            </div>
          </form>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Gambar</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($banks as $key => $bank)
                <tr>
                  <td>{{ $banks->firstItem() + $key }}</td>
                  <td>{{ $bank->name }}</td>
                  <td>
                    <img src="{{ asset('storage/uploads/' . $bank->image) }}" class="rounded" width="120px">
                  </td>
                  <td>
                    <form method="post" action="{{ url('bank/' . $bank->id) }}"
                      onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                      @csrf
                      @method('delete')
                      <a class="btn btn-info btn-sm" href="{{ url('bank/' . $bank->id) }}">
                        <i class="far fa-eye"></i>
                        Detail
                      </a>
                      <a class="btn btn-warning btn-sm" href="{{ url('bank/' . $bank->id . '/edit') }}">
                        <i class="far fa-edit"></i>
                        Ubah
                      </a>
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i>
                        Hapus
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix pb-0">
          <div class="pagination pagination-sm m-0 float-right">
            {{ $banks->appends(Request::all())->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </section>
@endsection
