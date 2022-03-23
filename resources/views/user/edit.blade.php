@extends('layouts.main')

@section('title', 'Ubah User')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-6">
          <h1 class="m-0 text-dark">Ubah User</h1>
        </div><!-- /.col -->
        <div class="col-6">
          <ol class="breadcrumb float-right">
            <li class="breadcrumb-item">
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('user') }}">User</a>
            </li>
            <li class="breadcrumb-item active">Ubah User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <form action="{{ url('user/' . $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ubah Pembeli</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-6 col-md-4 col-lg-4">
                @if ($user->image)
                  <img class="img-fluid rounded" src="{{ asset('storage/uploads/' . $user->image) }}"
                    class="rounded img-fluid">
                @else
                  <img class="img-fluid rounded" src="{{ asset('storage/uploads/user.png') }}"
                    class="rounded img-fluid">
                @endif
                <div class="form-group mt-4">
                  <label for="image">
                    Gambar
                    <br>
                    <small>(Kosongkan saja jika tidak ingin mengubah)</small>
                  </label>
                  <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror"
                    value="{{ old('image') }}" accept="image">
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col-6 col-md-8 col-lg-8">
                <div class="form-group">
                  <label for="name">Nama</label>
                  <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', $user->name) }}" autocomplete="off">
                  @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', $user->email) }}" autocomplete="off">
                  @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="row">
                  <div class="col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                      <label for="level">Level</label>
                      <select name="level" id="level" class="form-control @error('level') is-invalid @enderror">
                        <option value="">- Pilih -</option>
                        <option value="Buyer" {{ old('level', $user->level) == 'Buyer' ? 'selected' : null }}>Pembeli
                        </option>
                        <option value="Seller" {{ old('level', $user->level) == 'Seller' ? 'selected' : null }}>Penjual
                        </option>
                        <option value="Farmer" {{ old('level', $user->level) == 'Farmer' ? 'selected' : null }}>Petani
                        </option>
                      </select>
                      @error('level')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col-12 col-md-6 col-lg-6">
                    <div class="form-group">
                      <label for="gender">Jenis Kelamin</label>
                      <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
                        <option value="">- Pilih -</option>
                        <option value="L" {{ old('gender', $user->gender) == 'L' ? 'selected' : null }}>Laki-laki</option>
                        <option value="P" {{ old('gender', $user->gender) == 'P' ? 'selected' : null }}>Perempuan</option>
                      </select>
                      @error('gender')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>   
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror"
                    value="{{ old('phone', $user->phone) }}" autocomplete="off">
                  @error('phone')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="address">Alamat</label>
                  <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                    style="height: 75px">{{ old('address', $user->address) }}</textarea>
                  @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <hr>
            <h3 class="lead">
              <b>Ubah Password</b>
              <small>(Kosongkan saja jika tidak ingin mengubah)</small>
            </h3>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" id="password"
                    class="form-control @error('password') is-invalid @enderror">
                  @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="password_confirmation">Password Confirmation</label>
                  <input type="password" name="password_confirmation" id="password_confirmation"
                    class="form-control @error('password_confirmation') is-invalid @enderror">
                  @error('password_confirmation')
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
