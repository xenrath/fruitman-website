@extends('layouts.main')

@section('title', 'Detail Pembeli')

@section('content')
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
    crossorigin="" />
  <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
    integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
    crossorigin=""></script>
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail Produk</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('product') }}">Produk</a>
            </li>
            <li class="breadcrumb-item active">Detail Produk</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail Produk</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <h3>
            <strong>{{ ucfirst($product->name) }}</strong>
            ({{ $product->category }})
          </h3>
          <hr>
          <div class="row">
            <div class="col-4 d-none d-sm-block">
              <div class="row">
                <div class="col-10">
                  <p>
                    <strong>
                      Nama
                      @if ($product->user->level == 'Seller')
                        Penjual
                      @else
                        Petani
                      @endif
                    </strong>
                  </p>
                </div>
                <div class="col-2">
                  <p>
                    <strong>:</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <strong class="d-block d-sm-none">
                Nama
                @if ($product->user->level == 'Seller')
                  Penjual
                @else
                  Petani
                @endif
                :
              </strong>
              <p>{{ $product->user->name }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-4 d-none d-sm-block">
              <div class="row">
                <div class="col-10">
                  <p>
                    <strong>Nama Produk</strong>
                  </p>
                </div>
                <div class="col-2">
                  <p>
                    <strong>:</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <strong class="d-block d-sm-none">Nama Produk :</strong>
              <p>{{ $product->name }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-4 d-none d-sm-block">
              <div class="row">
                <div class="col-10">
                  <p>
                    <strong>Harga</strong>
                  </p>
                </div>
                <div class="col-2">
                  <p>
                    <strong>:</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <strong class="d-block d-sm-none">Harga :</strong>
              <p>{{ $product->price }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-4 d-none d-sm-block">
              <div class="row">
                <div class="col-10">
                  <p>
                    <strong>Deskripsi</strong>
                  </p>
                </div>
                <div class="col-2">
                  <p>
                    <strong>:</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <strong class="d-block d-sm-none">Deskripsi :</strong>
              <p>{{ $product->description }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col-4 d-none d-sm-block">
              <div class="row">
                <div class="col-10">
                  <p>
                    <strong>Alamat</strong>
                  </p>
                </div>
                <div class="col-2">
                  <p>
                    <strong>:</strong>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-sm-8 col-md-8 col-lg-8">
              <strong class="d-block d-sm-none">Alamat :</strong>
              <p>{{ $product->address }}, {{ $product->city->type }} {{ $product->city->name }},
                {{ $product->city->province->name }}, {{ $product->city->postal_code }}</p>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <div id="map" style="width:100%; height:400px;"></div>
              <script>
                // var location = {{ $result_lat_long }};
                var map = L.map('map').setView([{{ $product->latitude }}, {{ $product->longitude }}], 18);
                mapLink = '<a href="http://openstreetmap.org">OpenStreetMap</a>';
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                L.marker([{{ $product->latitude }}, {{ $product->longitude }}])
                  .addTo(map)
                  .bindPopup("{{ $product->name }}")
                  .openPopup();
              </script>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
    </div>
  </section>
@endsection
