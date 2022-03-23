@extends('layouts.main')

@section('title', 'Produk')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="">Home</a>
            </li>
            <li class="breadcrumb-item active">Produk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      {{-- @if (session('status'))
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-check"></i> {{ session('status') }}
        </div>
      @endif --}}
      @include('sweet::alert')
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Tabel Produk</h3>
          <div class="float-right">
            <a href="{{ url('product/create') }}" class="btn btn-success btn-sm">
              <i class="fa fa-plus"></i>
              Tambah
            </a>
          </div>
        </div>
        <div class="card-header">
          <div class="row">
            <div class="col-6">
              <form action="{{ url('product') }}" method="get">
                <div class="form-group row mb-0">
                  <label class="col-3 col-form-label" for="category">Pilih Kategori : </label>
                  <div class="col-7">
                    <select class="custom-select" id="category" name="category">
                      <option value="" {{ Request::get('category') == '' ? 'selected' : null }}>Semua</option>
                      <option value="Eceran" {{ Request::get('category') == 'Eceran' ? 'selected' : null }}>Eceran
                      </option>
                      <option value="Tebasan" {{ Request::get('category') == 'Tebasan' ? 'selected' : null }}>Tebasan
                      </option>
                    </select>
                  </div>
                  <div class="col-2">
                    <button type="submit" class="btn btn-primary">
                      <span class="fa fa-search"></span>
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-6">
              <form action="{{ url('product') }}" method="get">
                <div class="card-tools">
                  <div class="input-group">
                    <div class="col-3">
                      <label class="col-form-label" for="keyword">Cari : </label>
                    </div>
                    <div class="col-7">
                      <input type="search" class="form-control" name="keyword" id="keyword"
                        value="{{ Request::get('keyword') }}" autocomplete="off">
                    </div>
                    <div class="col-2">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">
                          <span class="fa fa-search"></span>
                        </button>
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
                <th>Nama</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Alamat</th>
                <th>Stok</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse ($products as $key => $product)
                <tr>
                  <td>{{ $products->firstItem() + $key }}</td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->category }}</td>
                  <td>@rupiah($product->price)</td>
                  <td>{{ $product->address }}</td>
                  <td>{{ $product->stock }}</td>
                  <td>
                    <form method="post" action="{{ url('product/' . $product->id) }}"
                      onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')">
                      @csrf
                      @method('delete')
                      <a class="btn btn-info btn-sm" href="{{ url('product/' . $product->id) }}">
                        <i class="far fa-eye"></i>
                        Detail
                      </a>
                      <a class="btn btn-warning btn-sm" href="{{ url('product/' . $product->id . '/edit') }}">
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
              @empty
                <tr>
                  <td colspan="7" class="text-center">
                    - Data Kosong -
                  </td>
                </tr>
              @endforelse
            </tbody>
          </table>
          <div class="float-right mr-3">
            {{ $products->appends(Request::all())->links('pagination::bootstrap-4') }}
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->
    </div>
  </section>
@endsection
