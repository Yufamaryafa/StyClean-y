@extends('admin')
@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
          <br>
          <br>
          <h2 style="color: rgb(18, 58, 122);">Data Transactions</h2>
        </div>
        
        <div class="col-sm-6">
            <br>
            <br>
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transactions Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <style>
    /* Menyamakan tampilan checkbox dengan radio button */
    .form-check-input[type="checkbox"]:checked+label::before {
        content: '\2713'; /* Tanda cek Unicode */
        background-color: #yourColor; /* Ganti dengan warna yang diinginkan */
        color: white; /* Warna teks */
        border-radius: 50%; /* Membuat bentuk bulat */
        padding: 2px; /* Ruang antara centang dan label */
    }
</style>
  <!-- Main content -->
<section class="content">

  <!-- Default box -->
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <br>
        <a href="{{ route('transactions.index') }}" class="btn btn-inverse-info">Kembali</a>
        <br>
        <br>
        <br>
        <form action ="{{ route('transactions.update', $transactions->id) }}" method="POST">
          @csrf
          @method('put')
          <div class="row">
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">No Unik</label>
                <div class="col-sm-9">
                  <input name="nomor_unik" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..." value="{{ random_int(1000000000, 9999999999)}}" readonly>
                  @error('nomor_unik')
                  <p>{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">Nama Pelanggan</label>
                <div class="col-sm-9">
                  <input name="nama_pelanggan" type="text" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..." value="{{$transactions->nama_pelanggan}}">
                  @error('nama_pelanggan')
                  <p>{{ $message }}</p>
                  @enderror  
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                  <label class="col-sm-6 col-form-label">Paket</label>
                  <div class="col-sm-9">
                      <select name="id_produk" class="form-control" style="border: 1px solid rgb(33, 68, 124);">
                          <option value="">- Pilih Paket -</option>
                          @foreach($productsM as $d)
                              <option value="{{ $d->id }}" {{ $d->id == $transactions->id_produk ? 'selected' : '' }}>
                                  {{ $d->nama_produk }} | {{ $d->harga_produk }} | {{ $d->min_berat}} | {{ $d->waktu }} | {{ $d->ket }}
                              </option>
                          @endforeach
                      </select>
                      @error('id_produk')
                          <p>{{ $message }}</p>
                      @enderror
                  </div>
              </div>
          </div>          
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">Est-Selesai</label>
                <div class="col-sm-9">
                  <input name="est_selesai" type="date" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..." value="{{$transactions->est_selesai}}">
                  @error('est_selesai')
                  <p>{{ $message }}</p>
                  @enderror  
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                <label class="col-sm-6 col-form-label">Uang Bayar</label>
                <div class="col-sm-9">
                  <input name="uang_bayar" type="number" class="form-control" style="border: 1px solid rgb(33, 68, 124);" placeholder="..." value="{{$transactions->uang_bayar}}">
                  @error('uang_bayar')
                  <p>{{ $message }}</p>
                  @enderror
                </div>
              </div>
            </div>
            <div class="col-md-6">
    <div class="form-group row">
        <label class="col-sm-6 col-form-label">Status Pengerjaan</label>
        <div class="col-sm-9">
            <select name="status_pengerjaan" class="form-control" style="border: 1px solid rgb(33, 68, 124);">
                <option value="">- Pilih Status -</option>
                <option value="Baru" {{ $transactions->status_pengerjaan == 'Baru' ? 'selected' : '' }}>Baru</option>
                <option value="Proses" {{ $transactions->status_pengerjaan == 'Proses' ? 'selected' : '' }}>Proses</option>
                <option value="Selesai" {{ $transactions->status_pengerjaan == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="Diambil" {{ $transactions->status_pengerjaan == 'Diambil' ? 'selected' : '' }}>Diambil</option>
            </select>
            @error('status_pengerjaan')
                <p>{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>
<div class="col-md-5">
  <div class="form-group row">
    <label class="col-sm-4 col-form-label">Status Pembayaran</label>
    <div class="col-md-8">
      <div class="form-check">
        <input name="pembayaran" type="radio" class="form-check-input" id="lunasRadio" value="lunas" {{ old('pembayaran', $transactions->pembayaran) !== 'belum lunas' ? 'checked' : '' }}>
        <label class="form-check-label" for="lunasRadio">Lunas</label>
      </div>
      <div class="form-check">
        <input name="pembayaran" type="radio" class="form-check-input" id="belumLunasRadio" value="belum lunas" {{ old('pembayaran', $transactions->pembayaran) === 'belum lunas' ? 'checked' : '' }}>
        <label class="form-check-label" for="belumLunasRadio">Belum Lunas</label>
      </div>
      @error('pembayaran')
        <p>{{ $message }}</p>
      @enderror
    </div>
  </div>
</div>
    </div>
          </div> 
               </div>
               <br>
         <button type="submit" class="btn btn-inverse-success btn-icon-text col-ms-3">
          <i class="icon-file btn-icon-prepend"></i>Simpan</button>
      </form>
    </div>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

</section>
<!-- /.content -->
@endsection