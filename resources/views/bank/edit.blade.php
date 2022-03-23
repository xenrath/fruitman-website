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
      <form action="{{ url('bank/' . $bank->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Ubah Bank</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="name">Nama</label>
              <input type="name" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $bank->name) }}" autofocus>
              @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="image">
                Gambar <small>(Kosongkan saja jika tidak ingin mengubah)</small>
              </label>
              <div class="custom-file">
                <input type="file" name="image" id="image" class="custom-file-input @error('image') is-invalid @enderror"
                  value="{{ old('image') }}">
                  <label class="custom-file-label" for="customFile">Choose file</label>
              </div>
              <div>
                <img class="rounded mt-3" src="{{ asset('storage/uploads/' . $bank->image) }}" width="240px">
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
    </div>
  </section>
@endsection
