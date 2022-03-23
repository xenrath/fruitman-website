@extends('layouts.main')

@section('title', 'Detail Pembeli')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Detail User</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="{{ url('home') }}">Home</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{ url('user') }}">User</a>
            </li>
            <li class="breadcrumb-item active">Detail User</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <section class="content">
    <div class="container-fluid">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Detail User</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <div class="row">
            <div class="col-4">
              @if ($user->image)
                <img class="rounded w-100" src="{{ asset('storage/uploads/' . $user->image) }}" width="240px">
              @else
                <img class="rounded w-100" src="{{ asset('storage/uploads/user.png') }}" width="240px">
              @endif
            </div>
            <div class="col-8">
              <h3>
                <strong>{{ ucfirst($user->name) }}</strong>
                @if ($user->level == 'Buyer')
                  (Pembeli)
                @elseif($user->level == 'Seller')
                  (Penjual)
                @else
                  (Petani)
                @endif
              </h3>
              <hr>
              <div class="row">
                <div class="col-4 d-none d-sm-block">
                  <div class="row">
                    <div class="col-10">
                      <p>
                        <strong>Email</strong>
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
                  <p class="d-block d-sm-none">
                    <strong>Email :</strong>
                  </p>
                  <p>{{ $user->email }}</p>
                </div>
              </div>
              <div class="row">
                <div class="col-4 d-none d-sm-block">
                  <div class="row">
                    <div class="col-10">
                      <p>
                        <strong>Jenis Kelamin</strong>
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
                  <p class="d-block d-sm-none">
                    <strong>Jenis Kelamin :</strong>
                  </p>
                  <p>
                    @if ($user->gender == 'L')
                      Laki-laki
                    @else
                      Perempuan
                    @endif
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-4 d-none d-sm-block">
                  <div class="row">
                    <div class="col-10">
                      <p>
                        <strong>No. Telepon</strong>
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
                  <p class="d-block d-sm-none">
                    <strong>No. Telepon :</strong>
                  </p>
                  <p>{{ $user->phone }}</p>
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
                  <p class="d-block d-sm-none">
                    <strong>Alamat :</strong>
                  </p>
                  <p>{{ $user->address }}</p>
                </div>
              </div>
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
