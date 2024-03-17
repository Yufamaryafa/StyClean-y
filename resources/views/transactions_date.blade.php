@extends('admin')
@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
          <br>
          <br>
          <h2 style="color: rgb(18, 58, 122);">Cetak Pertanggal</h2>
        </div>
        
        <div class="col-sm-6">
          <br>
          <br>
          <ol class="breadcrumb float-sm-right bg-inverse-primary">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pertanggal Transactions</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  {{-- Main content --}}
<section class="content">

  <!-- Default box -->
  <div class="table-responsive p-3">
      <a href="{{ route('transactions.index') }}" 
      class="btn btn-inverse-info">Kembali</a>
      <br>
      <br>
      <form action="{{ route('transactions.pertanggal', ['tgl_awal' => '2023-01-01', 'tgl_akhir' => '2023-12-31']) }}" method="GET" id="laporanForm">
         <div class="col-md-9">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Awal</label>
              <div class="col-sm-10">
                <input name="tgl_awal" type="date" class="form-control" style="border: 1px solid rgb(33, 68, 124);">
                @error('tgl_awal') 
                <p>{{ $message }}</p>
                @enderror  
              </div>
            </div>
          </div>
         <div class="col-md-9">
            <div class="form-group row">
              <label class="col-sm-2 col-form-label">Tanggal Akhir</label>
              <div class="col-sm-10">
                <input name="tgl_akhir" type="date" class="form-control" style="border: 1px solid rgb(33, 68, 124);">
                @error('tgl_akhir') 
                <p>{{ $message }}</p>
                @enderror  
              </div>
            </div>
          </div>
          <h6>*Tanggal Akhir tidak masuk data</h6>
          
          <button type="button" class="btn btn-inverse-success col-md-2" onclick="searchData()">Tampilkan Data</button>
      </form>
  <br>
  <div class="table-responsive p-3">
    <table id="myTable" class="table table-bordered align-items-center mb-0">
      <thead>
          <tr>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">No Unik</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama Pelanggan</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Paket</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Uang Bayar</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Uang Kembali</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status Bayar</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Est Selesai</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status Pengerjaan</th>
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tanggal</th>
              @if (Auth::user()->role == 'admin')
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Aksi</th>
              @endif
              @if (Auth::user()->role == 'kasir')
              <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Aksi</th>
              @endif
          </tr>
      </thead>
    </div>
      <tbody>
          @if (count($transactions) > 0)
          @foreach ($transactions as $peserta)
          <tr>
            <td class="text-center">{{ $peserta->nomor_unik }}</td>
            <td class="text-center">{{ $peserta->nama_pelanggan }}</td>
            <td>{{ $peserta->products->nama_produk }} - {{ $peserta->products->harga_produk }} - {{ $peserta->products->harga_produk }} - {{ $peserta->products->min_berat}} - {{ $peserta->products->ket }} </td>
            <td class="text-center">{{ $peserta->uang_bayar }}</td>
            <td class="text-center">{{ $peserta->uang_kembali }}</td>
            <td class="text-center">
              @if ($peserta->pembayaran == 'Lunas')
                  <span class="badge badge-success">Lunas</span>
              @elseif ($peserta->pembayaran == 'Belum Lunas')
                  <span class="badge badge-danger">Belum Lunas</span>
              @endif
          </td>
          <td class="text-center">
            {{ \Carbon\Carbon::parse($peserta->est_selesai)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </td>
            <td class="text-center">
                @if ($peserta->status_pengerjaan == 'Baru')
                    <span class="badge badge-info">Baru</span>
                @elseif ($peserta->status_pengerjaan == 'Proses')
                    <span class="badge badge-warning">Proses</span>
                @elseif ($peserta->status_pengerjaan == 'Selesai')
                    <span class="badge badge-primary">Selesai</span>
                @elseif ($peserta->status_pengerjaan == 'Diambil')
                    <span class="badge badge-success">Diambil</span>
                @endif
            </td>
            <td class="text-center">
              {{ \Carbon\Carbon::parse($peserta->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
              @if (Auth::user()->role !== 'owner')
              <td class="text-center">
                  <form action="{{route('transactions.destroy', $peserta->id_tran)}}" method="POST">
                      @if (Auth::user()->role == 'admin')
                      <a href="{{route('transactions.edit', $peserta->id_tran)}}" class="btn btn-xs btn-inverse-warning p-2">
                          <i class="icon-file"></i> 
                      </a>
                      @endif
                      {{-- @if (Auth::user()->role !== 'owner') --}}
                      {{-- <a href="{{route('transactions.pdf', $peserta->id_tran)}}" class="btn btn-xs btn-outline-primary">
                          <i class="fas fa-file-alt"></i>
                      </a>    --}}
                       {{-- @endif --}}
                      @if (Auth::user()->role == 'admin')
                      @csrf
                      @method('delete')
                      <button type="submit" class="btn btn-xs btn-inverse-danger p-2" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                          <i class="icon-trash"></i>
                      </button>
                      @endif
                      @if (Auth::user()->role == 'kasir')
                      <a href="{{ route('transactions.generateStruk', $peserta->id_tran) }}" class="btn btn-inverse-success p-2">Lihat Invoice</a>
                      @endif
                  </form>
              </td>
              @endif
          </tr>
          @endforeach
          @else
          <tr>
              <td colspan="8"> Data Tidak Ditemukan </td>
          </tr>
          @endif
      </tbody>
  </table>
  </div>
</div> 
</div>
</div>
</div>
</div>

    <!-- /.card-body -->
    <!-- /.card-footer-->
  <!-- /.card -->

</section>
<script>
function searchData() {
    // Ambil nilai input tanggal dari form
    var tgl_awal = document.querySelector('input[name="tgl_awal"]').value;
    var tgl_akhir = document.querySelector('input[name="tgl_akhir"]').value;

    // Kirim form menggunakan AJAX
    $.ajax({
        url: "http://127.0.0.1:8000/pertanggal/" + tgl_awal + "/" + tgl_akhir,
        method: "GET",
        success: function(data) {
            // Isi tabel dengan hasil yang diterima dari AJAX
            $('#myTable tbody').html(data);
        },
        error: function(xhr, status, error) {
            // Tangani kesalahan jika ada
            console.error(xhr.responseText);
        }
    });
}

</script>


<!-- /.content -->
@endsection
