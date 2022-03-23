@extends('layouts.main')

@section('title', 'Transaksi Masuk')

@section('content')
  @if (session('status'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fas fa-check"></i> {{ session('status') }}
    </div>
  @endif
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-9">
          <form method="get" action="{{route('income.index')}}">
            <div class="form-group">
              <label for="nama_produk" class="control-label">Cari berdasarkan tanggal</label>
              <div class="row">
                <div class="col-5">
                  <input type="date" name="start_date" placeholder="Start Date" class="form-control"/>
                  <p class="text-center">Tanggal mulai</p>
                </div>
                <div class="col-5">
                  <input type="date" name="end_date"  placeholder="Finish Date" class="form-control"/>    
                  <p class="text-center">Tanggal akhir</p>
                </div>
                <div class="col-2">
                  <button type="submit" class="btn btn-info"><span class="fa fa-search"></span></button>
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="col-3">
          <div class="float-right">
            @if( Request::get('start_date') != "" && Request::get('end_date') != "")
              <a class="btn btn-success"  href="{{ route('income.index') }}">Back</a>
            @else
              <a class="btn btn-success"  href="{{ route('income.create') }}"><span class="fa fa-plus"></span> Tambah</a>
            @endif
          </div>
        </div>  
      </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Penjual</th>
            <th>Tanggal</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($incomes as $key => $income)
          <tr>
            <td>{{ $incomes->firstItem() + $key }}</td>
            <td>{{ $income->product['name'] }}</td>
            <td>{{ $income->seller['name'] }}</td>
            <td>{{ $income->date }}</td>
            <td>{{ $income->quantity }}</td>
            <td>@rupiah($income->price)</td>
            <td>
              <form method="post" action="{{ url('income/'.$income->id) }}" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')" >
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="float-right mr-3">
        {{ $incomes->appends(Request::all())->links('pagination::bootstrap-4') }}
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection