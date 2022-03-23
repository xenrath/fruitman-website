@extends('layouts.main')

@section('title', 'Ubah Penjual')

@section('content')
<form action="{{ url('seller/'.$seller->id) }}" method="post" enctype="multipart/form-data">
  @csrf
  @method('put')
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Ubah Penjual</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $seller->email) }}" autofocus>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
        <small>Kosongkan saja jika tidak ingin mengubah</small>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="name">Nama</label>
        <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $seller->name) }}">
        @error('name')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="gender">Jenis Kelamin</label>
        <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror">
          <option value="">- Pilih -</option>
          <option value="L" {{ $seller->gender == 'L' ? 'selected' : null }}>Laki-laki</option>
          <option value="P" {{ $seller->gender == 'P' ? 'selected' : null }}>Perempuan</option>
        </select>
        @error('gender')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone', $seller->phone) }}">
        @error('phone')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="address">Alamat</label>
        <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror" rows="4">{{ old('address', $seller->address) }}</textarea>
        @error('address')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="image">Gambar</label>
        <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}">
        <small>Kosongkan saja jika tidak ingin mengubah</small>
        <div>
          <img class="img-thumbnail mt-2" src="{{ asset('storage/uploads/'.$seller->image) }}" width="200px">
        </div>
        @error('image')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
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
@endsection