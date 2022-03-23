@extends('layouts.main')

@section('title', 'Penjual')

@section('content')
  @if (session('status'))
    <div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <i class="icon fas fa-check"></i> {{ session('status') }}
    </div>
  @endif
  @if (Request::get('keyword'))
    <div class="alert alert-success alert-block">
      Hasil pencarian penjual dengan Keyword : <b>{{ Request::get('keyword') }}</b>
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    </div>
  @endif
  <div class="card">
    <div class="card-header">
      <form action="{{ url('seller') }}">
        <div class="form-group">
          <label for="keyword" class="control-label">Cari berdasarkan nama : </label>
          @if (Request::get('keyword'))
            <div class="float-right">
              <a href="{{ url('seller') }}" class="btn btn-success">Back</a>
            </div>  
          @else
            <div class="float-right">
              <a href="{{ url('seller/create') }}" class="btn btn-success"><span class="fa fa-plus"></span> Create</a>
            </div>
          @endif
          <div class="row">
            <div class="">
              <input type="text" class="form-control" id="keyword" name="keyword" value="{{ Request::get('keyword') }}">
            </div>
            <div class="">
              <button type="submit" class="btn btn-info ml-2"><span class="fa fa-search"></span></button>
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body p-0">
      <table class="table table-striped">
        <thead>
          <tr>
            <th>No</th>
            <th>Email</th>
            <th>Nama</th>
            <th>No. Telepon</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($sellers as $key => $seller)
          <tr>
            <td>{{ $sellers->firstItem() + $key }}</td>
            <td>{{ $seller->email }}</td>
            <td>{{ $seller->name }}</td>
            <td>{{ $seller->phone }}</td>
            <td>
              <form method="post" action="{{ url('seller/'.$seller->id) }}" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini?')" >
              @csrf
              @method('delete')
              <a class="btn btn-warning" href="{{ url('seller/'.$seller->id.'/edit') }}">Ubah</a>
              <button type="submit" class="btn btn-danger">Delete</button>
              <a class="btn btn-info" href="{{ url('seller/'.$seller->id) }}">Detail</a>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      <div class="float-right mr-3">
        {{-- {{ $buyers->links('pagination::bootstrap-4') }} --}}
        {{ $sellers->appends(Request::all())->links('pagination::bootstrap-4') }}
      </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection