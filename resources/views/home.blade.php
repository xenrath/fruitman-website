@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>

  <section class="content">
    <div class="container-fluid">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="row">
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-info elevation-1">
              <i class="fas fa-users"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Data Users</span>
              <span class="info-box-number">
                {{-- {{ $users }} --}}
                <small>Data</small>
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-secondary elevation-1">
              <i class="fas fa-shopping-bag"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Data Products</span>
              <span class="info-box-number">
                {{-- {{ $users }} --}}
                <small>Data</small>
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-danger elevation-1">
              <i class="fas fa-money-bill-wave"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Data Transactions</span>
              <span class="info-box-number">
                {{-- {{ $users }} --}}
                <small>Data</small>
              </span>
            </div>
          </div>
        </div>
        <div class="col-12 col-sm-6 col-md-3 col-lg-3">
          <div class="info-box">
            <span class="info-box-icon bg-warning elevation-1">
              <i class="fas fa-university"></i>
            </span>
            <div class="info-box-content">
              <span class="info-box-text">Data Banks</span>
              <span class="info-box-number">
                {{-- {{ $users }} --}}
                <small>Data</small>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
@endsection
