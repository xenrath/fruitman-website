@extends('layouts.main')

@section('title', 'User')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-6">
          <h1 class="m-0 text-dark">User</h1>
        </div><!-- /.col -->
        <div class="col-6">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item">
              <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">User</li>
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
          <h3 class="card-title">Tabel User</h3>
          <div class="float-right">
            <a href="{{ url('user/create') }}" class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i>
              Tambah
            </a>
          </div>
        </div>
        <div class="card-header">
          <div class="row">
            <div class="col">
              <form action="{{ url('user') }}" method="get">
                <div class="form-group row mb-0">
                  <div class="col-12 col-lg-3">
                    <label class="col-form-label d-none d-xl-block" for="level">Pilih Level : </label>
                    <label class="d-xl-none" for="level">Pilih Level : </label>
                  </div>
                  <div class="col-12 col-lg-9">
                    <div class="row">
                      <div class="col-9">
                        <select class="custom-select" id="level" name="level">
                          <option value="" {{ Request::get('level') == '' ? 'selected' : null }}>Semua</option>
                          <option value="Buyer" {{ Request::get('level') == 'Buyer' ? 'selected' : null }}>Pembeli</option>
                          <option value="Seller" {{ Request::get('level') == 'Seller' ? 'selected' : null }}>Penjual
                          </option>
                          <option value="Farmer" {{ Request::get('level') == 'Farmer' ? 'selected' : null }}>Petani</option>
                        </select>
                      </div>
                      <div class="col-3">
                        <button type="submit" class="btn btn-primary">
                          <span class="fa fa-search"></span>
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <div class="col">
              <form action="{{ url('user') }}" method="get">
                <div class="card-tools">
                  <div class="input-group">
                    <div class="col-12 col-lg-3">
                      <label class="col-form-label d-none d-xl-block" for="keyword">Cari : </label>
                      <label class="d-xl-none" for="keyword">Cari : </label>
                    </div>
                    <div class="col-12 col-lg-9">
                      <div class="row">
                        <div class="col-9">
                          <input type="search" class="form-control" name="keyword" id="keyword"
                            value="{{ Request::get('keyword') }}" autocomplete="off">
                        </div>
                        <div class="col-3">
                          <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                              <span class="fa fa-search"></span>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- /.card-tools -->
              </form>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body p-0">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>No</th>
                <th>Email</th>
                <th class="d-none d-sm-block">Nama</th>
                <th>Level</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($users as $key => $user)
                <tr>
                  <td>{{ $users->firstItem() + $key }}</td>
                  <td>{{ $user->email }}</td>
                  <td class="d-none d-sm-block">{{ $user->name }}</td>
                  <td>{{ $user->level }}</td>
                  <td>
                    <form method="post" action="{{ url('user/' . $user->id) }}"
                      onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                      @csrf
                      @method('delete')
                      <a class="btn btn-info btn-sm" href="{{ url('user/' . $user->id) }}">
                        <i class="far fa-eye"></i>
                        <span class="d-none d-sm-inline d-lg-inline">Detail</span>
                      </a>
                      <a class="btn btn-warning btn-sm" href="{{ url('user/' . $user->id . '/edit') }}">
                        <i class="far fa-edit"></i>
                        <span class="d-none d-sm-inline">Ubah</span>
                      </a>
                      <button type="submit" class="btn btn-danger btn-sm">
                        <i class="far fa-trash-alt"></i>
                        <span class="d-none d-sm-inline">Hapus</span>
                      </button>
                    </form>
                  </td>
                </tr>
              @empty
                <tr>
                  <td colspan="7" class="text-center">
                    - Data Kosong -
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix pb-0">
          <div class="pagination pagination-sm m-0 float-right">
            {{ $users->appends(Request::all())->links('pagination::bootstrap-4') }}
          </div>
        </div>
      </div>
      <!-- /.card -->
    </div>
  </section>
@endsection
