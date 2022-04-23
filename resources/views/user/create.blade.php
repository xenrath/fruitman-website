@extends('layouts.main')

@section('title', 'Tambah User')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-6">
          <h1 class="m-0 text-dark">Tambah User</h1>
        </div><!-- /.col -->
        <div class="col-6">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item">
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('user') }}">User</a>
            </li>
            <li class="breadcrumb-item active">Tambah User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <form action="{{ url('user') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Pembeli</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name') }}" autocomplete="off">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="level">Level</label>
                  <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                    <option value="">- Pilih -</option>
                    <option value="Buyer" {{ old('level') == 'Buyer' ? 'selected' : null }}>Pembeli</option>
                    <option value="Seller" {{ old('level') == 'Seller' ? 'selected' : null }}>Penjual</option>
                    <option value="Farmer" {{ old('level') == 'Farmer' ? 'selected' : null }}>Petani</option>
                  </select>
                  @error('level')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email') }}" autocomplete="off">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid autocomplete="off" @enderror"
                    value="{{ old('password') }}">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="gender">Jenis Kelamin</label>
                  <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                    <option value="">- Pilih -</option>
                    <option value="L" {{ old('gender') == 'L' ? 'selected' : null }}>Laki-laki</option>
                    <option value="P" {{ old('gender') == 'P' ? 'selected' : null }}>Perempuan</option>
                  </select>
                  @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone') }}" autocomplete="off">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                    rows="3">{{ old('address') }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="image">Gambar</label>
                  <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"
                    value="{{ old('image') }}" accept="image" autocomplete="off">
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="reset" class="btn btn-secondary">
              <i class="fa fa-redo"></i> Reset
            </button>
            <button type="submit" class="btn btn-success float-right">
              <i class="fa fa-save"></i> Save
            </button>
          </div>
        </div>
        <!-- /.card -->
      </form>
    </div>
  </section>
@endsection
