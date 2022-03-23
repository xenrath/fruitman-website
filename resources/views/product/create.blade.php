@extends('layouts.main')

@section('title', 'Tambah Produk')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Tambah Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('product') }}">Produk</a>
            </li>
            <li class="breadcrumb-item active">Tambah Produk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <form action="{{ url('product') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Tambah Produk</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col">
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="user_id">User</label>
                      <select name="user_id" id="user_id" class="form-control @error('user_id') is-invalid @enderror">
                        <option value="">- Pilih -</option>
                        @foreach ($users as $user)
                          <option value="{{ $user->id }}">
                            {{ $user->name }}</option>
                        @endforeach
                      </select>
                      @error('user_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="category">Kategori</label>
                      <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
                        <option value="">- Pilih User -</option>
                      </select>
                      @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
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
                      <label for="price">Harga</label>
                      <input type="number" name="price" id="price"
                        class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}"
                        autocomplete="off">
                      @error('price')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="description">Deskripsi</label>
                      <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                        rows="3">{{ old('description') }}</textarea>
                      @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
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
                </div>
                <div class="row">
                  <div class="col">
                    <div class="form-group">
                      <label for="latitude">Latitude</label>
                      <input type="text" name="latitude" id="latitude"
                        class="form-control @error('latitude') is-invalid @enderror" value="{{ old('latitude') }}"
                        autocomplete="off">
                      @error('latitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                  <div class="col">
                    <div class="form-group">
                      <label for="longitude">Longitude</label>
                      <input type="text" name="longitude" id="longitude"
                        class="form-control @error('longitude') is-invalid @enderror" value="{{ old('longitude') }}"
                        autocomplete="off">
                      @error('longitude')
                        <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="province_id">Provinsi</label>
                  <select name="province_id" id="province_id"
                    class="form-control @error('province_id') is-invalid @enderror">
                    <option value="">- Pilih -</option>
                    @foreach ($provinces as $province => $id)
                      <option value="{{ $id }}" {{ old('province_id') == $id ? 'selected' : null }}>
                        {{ $province }}</option>
                    @endforeach
                  </select>
                  @error('province_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="city_id">Kota / Kabupaten</label>
                  <select name="city_id" id="city_id" class="form-control @error('city_id') is-invalid @enderror">
                    <option value="">- Pilih Provinsi -</option>
                  </select>
                  @error('city_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="postal_code">Postal Code</label>
                  <input type="text" name="postal_code" id="postal_code"
                    class="form-control @error('postal_code') is-invalid @enderror" value="{{ old('postal_code') }}"
                    autocomplete="off" disabled>
                  @error('postal_code')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col">
                <div class="form-group">
                  <label for="image">Gambar</label>
                  <input type="file" name="image[]" id="image" class="form-control @error('image') is-invalid @enderror"
                    value="{{ old('image') }}" multiple accept="image/*" autocomplete="off">
                  @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
              <div class="col">
                <div class="form-group">
                  <label for="stock">Stok</label>
                  <input type="number" name="stock" id="stock" class="form-control @error('stock') is-invalid @enderror"
                    value="{{ old('stock') }}" autocomplete="off">
                  @error('stock')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            {{-- <button type="reset" class="btn btn-secondary">
              <i class="fa fa-redo"></i> Reset
            </button> --}}
            <a href="{{ url('test') }}">test</a>
            <button type="submit" class="btn btn-success float-right">
              <i class="fa fa-save"></i> Save
            </button>
          </div>
        </div>
        <!-- /.card -->
      </form>
    </div>
  </section>
  <script>
    $(document).ready(function() {
      $('select[name="user_id"]').on('change', function() {
        let userId = $(this).val();
        if (userId) {
          jQuery.ajax({
            url: '/tugas-akhir/fruitman/category/' + userId,
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('select[name="category"]').empty();
              $.each(data, function(key, value) {
                $('select[name="category"]').append('<option value="' + key + '">' + value +
                  '</option>');
              });
            },
          });
        } else {
          $('select[name="category"]').empty();
          $('select[name="category"]').append('<option value="">- Pilih User -</option>');
        }
      });
      $('select[name="province_id"]').on('change', function() {
        let provinceId = $(this).val();
        if (provinceId) {
          jQuery.ajax({
            url: '/tugas-akhir/fruitman/cities/' + provinceId,
            type: "GET",
            dataType: "json",
            success: function(data) {
              $('select[name="city_id"]').empty();
              $('select[name="city_id"]').append('<option value="">- Pilih Kota / Kabupaten -</option>');
              $.each(data, function(key, city) {
                $('select[name="city_id"]').append('<option value="' + city.id + '">' + city.type +
                  ' ' + city.name + '</option>');
              });
            },
          });
        } else {
          $('select[name="city_id"]').empty();
          $('select[name="city_id"]').append('<option value="">- Pilih Provinsi -</option>');
        }
      });
      $('select[name="city_id"]').on('change', function() {
        let cityId = $(this).val();
        if (cityId) {
          jQuery.ajax({
            url: '/tugas-akhir/fruitman/postal_code/' + cityId,
            type: "GET",
            dataType: "json",
            success: function(data) {
              if (data) {
                $('#postal_code').val(data.postal_code);
              } else {
                $('#postal_code').val(null);
              }
            },
          });
        } else {
          $('#postal_code').val(null);
        }
      });
    })
  </script>
@endsection
