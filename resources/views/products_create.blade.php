@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-5">
        <br>
        <br>
        <h2 style="color: rgb(18, 58, 122);">Tambah Data Produk</h2>
      </div>
      <div class="col-sm-6">
        <br>
        <br>
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Produk Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <br>
        <a href="{{ route('products.index') }}" class="btn btn-inverse-info">Kembali</a>
        <br>
        <br>
        <br>
        <form action ="{{ route('products.store') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Nama Produk</label>
                <div class="col-sm-9">
                  <input name="nama_produk" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                  @error('nama_produk')
                  <p>{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Harga</label>
                <div class="col-sm-9">
                  <input name="harga_produk" type="number" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                  @error('harga_produk') 
                  <p>{{ $message }}</p>
                  @enderror  
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Waktu Pengerjaan</label>
                <div class="col-sm-9">
                  <input name="waktu" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                  @error('waktu')
                  <p>{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Berat</label>
                <div class="col-sm-9">
                  <input name="min_berat" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                  @error('min_berat')
                  <p>{{ $message }}</p>
                  @enderror  
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-3 col-form-label">Keterangan</label>
                <div class="col-sm-9">
                  <input name="ket" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                  @error('ket')
                  <p>{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
          </div>
        <br>
        <button type="submit" class="btn btn-outline-success btn-icon-text">
          <i class="icon-file btn-icon-prepend"></i>
          Tambah
        </button>
      </form>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

</section>
<!-- /.content -->
@endsection
