@extends('admin')
@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
          <br>
          <br>
          <h2 style="color: rgb(18, 58, 122);">Data Products</h2>
        </div>
        
        <div class="col-sm-6">
          <br>
          <br>
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Produk Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  {{-- Main content --}}
<section class="content">

 <div class="table-responsive p-3">
  @if($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
  @endif
  @if (Auth::user()->role == 'admin')
    <a href="{{route('products.create')}}" class="btn btn-inverse-success">Tambah Data</a>
    @endif
    @if (Auth::user()->role == 'owner')
    <a href="{{route('products.pdf')}}" class="btn btn-inverse-primary">Unduh PDF</a>
    @endif
       <br>
        <br>

        <table id="myTable" class="table table-bordered align-items-center mb-0">
            <thead>
              <tr>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama Produk</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Berat Min(Kg)</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Waktu Pengerjaan</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Harga</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Keterangan Bahan</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                @if (Auth::user()->role == 'admin')
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Aksi</th>
                @endif
              </tr>
            </thead>
              <tbody>
                @if (count($productsM) > 0)
                  @foreach ($productsM as $peserta)
                    <tr>
                      <td class="text-center">{{ $peserta->nama_produk }}</td>
                      <td class="text-center">{{ $peserta->min_berat }}</td>
                      <td class="text-center">{{ $peserta->waktu }}</td>
                      <td class="text-center">{{ $peserta->harga_produk }}</td>
                      <td class="text-center">{{ $peserta->ket }}</td>
                      <td class="text-center">{{ \Carbon\Carbon::parse($peserta->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>    
                      </td>
                      @if (Auth::user()->role == 'admin')
                      <td class="text-center"> 
                        <form action="{{route('products.destroy', $peserta->id)}}" method="POST">
                          <a href="{{route('products.edit', $peserta->id)}}" class="btn btn-xs btn-inverse-warning p-2">
                            <i class="icon-file menu-icon"></i>
                          </a>
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-xs btn-inverse-danger p-2" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            <i class="icon-trash"></i>
                          </button>
                        </form>
                      </td>
                      @endif
                    </tr>
                  @endforeach
                @else
                  <tr>
                    <td colspan="8">Data Tidak Ditemukan</td>
                  </tr>
                @endif
              </tbody>
            </table>
          </div>
  

 
@endsection
