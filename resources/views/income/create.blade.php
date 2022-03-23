@extends('layouts.main')

@section('title', 'Tambah Stok Produk')

@section('content')
<form action="{{ url('income') }}" method="post">
  @csrf
  <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Tambah Stok Produk</h3>
    </div>
    <div class="card-body">
      <div class="form-group">
        <label for="seller_id">Penjual</label>
        <select name="seller_id" id="seller_id" class="form-control @error('seller_id') is-invalid @enderror">
          <option value="">- Pilih -</option>
          @foreach ($sellers as $seller)
            <option value="{{ $seller->id }}" {{ old('seller_id') == $seller->id ? 'selected' : null }}>{{ $seller->name }}</option>
          @endforeach
        </select>
        @error('seller_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="product_id">Nama Produk</label>
        <select name="product_id" id="product_id" class="form-control @error('product_id') is-invalid @enderror">
          <option value="">- Pilih -</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : null }}>{{ $product->name }}</option>
          @endforeach
        </select>
        @error('product_id')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="date">Tanggal</label>
        <input type="date" name="date" id="date" class="form-control @error('date') is-invalid @enderror" value="{{ old('date') }}">
        @error('date')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="quantity">Jumlah</label>
        <input type="number" name="quantity" id="quantity" class="form-control @error('quantity') is-invalid @enderror" value="{{ old('quantity') }}">
        @error('quantity')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>
      <div class="form-group">
        <label for="price">Harga</label>
        <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}">
        @error('price')
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
        <i class="fa fa-save"></i> Simpan
      </button>
    </div>
  </div>
  <!-- /.card -->
</form>
@endsection