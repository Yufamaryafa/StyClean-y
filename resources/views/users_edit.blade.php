@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-5">
        <br>
        <br>
        <h2 style="color: rgb(18, 58, 122);">Edit Data Pengguna</h2>
      </div>
      <div class="col-sm-6">
        <br>
        <br>
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Edit Pengguna Page</li>
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
        <a href="{{ route('users.index') }}" class="btn btn-inverse-info">Kembali</a>
        <br>
        <br>
        <form action ="{{ route('users.update', $data->id) }}" method="POST">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Nama</label>
                <div class="col-sm-9">
                  <input name="nama" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..." value="{{ $data->nama }}">
                  @error('nama')
                  <p>{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Username</label>
                <div class="col-sm-9">
                  <input name="username" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..." value="{{ $data->username }}">
                  @error('username')
                  <p>{{ $message }}</p>
                  @enderror  
                </div>
              </div>
            </div>
                <div class="card-body">
                <div class="btn-group">
                  <button type="button" class="btn btn-info">Role</button>
                  <select name="role" type="button" class="btn btn-inverse-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <div class="dropdown-menu">
                    <option value="kasir" @if($data->role === 'kasir') selected @endif>Kasir</option>
                    <option value="owner" @if($data->role === 'owner') selected @endif>Owner</option>
                    <option value="admin" @if($data->role === 'admin') selected @endif>Admin</option>
                  </select>
                  @error('role')
                      <p>{{ $message }}</p>
                  @enderror
                  </div>
                </div>
                </div>
                <br>
                  <button type="submit" class="btn btn-inverse-success col-sm-2">Simpan</button>
                    </form>
                  </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
    </div>
</section>
@endsection