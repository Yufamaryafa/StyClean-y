@extends('admin')
@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-5">
        <br>
        <br>
        <h2 style="color: rgb(18, 58, 122);">Ubah Data User</h2>
      </div>
      <div class="col-sm-6">
        <br>
        <br>
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
          <li class="breadcrumb-item active">Change User Page</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

    <div class="col-12 grid-margin">
        <div class="card">
          <div class="card-body">
            <a href="{{ route('users.index') }}" class="btn btn-inverse-info">Kembali</a>
            <br>
            <br>
            <form action="{{ route('users.change', $data->id) }}" method="POST">
            @csrf
            @method('put')
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Username</label>
                    <div class="col-sm-9">
                      <input name="username" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" value="{{ $data->username}}" readonly>
                      @error('username')
                      <p>{{ $message }}</p>
                      @enderror  
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group row">
                    <label class="col-sm-6 col-form-label">Password Baru</label>
                    <div class="col-sm-9">
                      <input name="password_new" type="password" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                      @error('password_new')
                      <p>{{ $message }}</p>
                      @enderror
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group row">
                    <label class="col-sm-7 col-form-label">Konfirmasi Password</label>
                    <div class="col-sm-9">
                      <input name="password_confirm" type="password" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..."/>
                      @error('password_confirm')
                      <p>{{ $message }}</p>
                      @enderror  
                    </div>
                  </div>
                </div>
                <div class="card-body">
                      <button type="submit" class="btn btn-inverse-success col-sm-">Simpan</button>
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