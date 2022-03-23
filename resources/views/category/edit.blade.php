@extends('layouts.main')

@section('title', 'Ubah Kategori')

@section('content')
<form action="{{ url('category/'.$category->id) }}" method="post">
  @csrf
  @method('put')
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Ubah Kategori</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="category">Kategori</label>
        <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{ old('category', $category->category) }}">
        @error('category')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="description">Deskripsi</label>
        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $category->description) }}</textarea>
        @error('description')
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