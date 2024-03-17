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

  {{-- Main content --}}
<section class="content">

  <div class="table-responsive p-3"> <!-- Add padding to the table -->
                <div>
                    <form action="{{ route('laporan.filter') }}" method="GET" class="row" id="laporanForm">
                        <div class="form-group col-md-5">
                            <label for="startDate">Tanggal Awal:</label>
                            <input type="date" name="startDate" id="startDate" class="form-control" value="{{ request('startDate') }}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="endDate">Sampai</label>
                            <input type="date" name="endDate" id="endDate" class="form-control" value="{{ request('endDate') }}">
                        </div>
                        <div class="form-group col-md-2">
                            <br>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <button type="button" class="btn btn-primary" onclick="searchData()">
                                  <i class="icon-search"></i>
                                </button>
                                <a href="{{ route('laporan.index') }}" class="btn btn-primary">
                                    <i class="ti-reload"></i>
                                  </a>      
                              </div>
                        </div>
                        <div>
                            @if(request()->has('startDate') && request()->has('endDate'))
                                <a href="{{ route('laporan.export', ['startDate' => request('startDate'), 'endDate' => request('endDate')]) }}" class="btn btn-inverse-primary">Cetak PDF</a>
                                </a>
                            @endif
                        </div>
                    </form>
                    <div class="d-flex justify-content-between align-items-center col-md-4">
                        <!-- ... (additional content if needed) ... -->
                    </div>
                    <br>
    
                    @if (count($transactionsM) > 0)
                    <div class="table-responsive">
                        <table id="myTable" class="table table-bordered align-items-center mb-0">
                    <thead>
                    <tr>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">No Unik</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama Pelanggan</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Paket</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Uang Bayar</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Uang Kembali</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status Bayar</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Perkiraan Selesai</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status Pengerjaan</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tanggal</th>
                    </tr>
                    </thead>
                                @if (count($transactionsM) > 0)
                                    <tbody>
                                        {{-- @php
                                            $totalHarga = 0;
                                        @endphp --}}
                                        @foreach ($transactionsM as $peserta)
                                            <tr>
                                                <td class="text-center">{{ $peserta->nomor_unik }}</td>
                                                <td class="text-center">{{ $peserta->nama_pelanggan }}</td>
                                                <td >{{ $peserta->products->nama_produk }} - {{ $peserta->products->harga_produk }} - {{ $peserta->products->min_berat}} - {{ $peserta->products->ket }} </td>
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
                                                </td>  
                                            </tr>
                                            {{-- @php
                                                $totalHarga += $data->harga_produk;
                                            @endphp --}}
                                        @endforeach
                                    </tbody>
                                    {{-- <tfoot>
                                        <tr>
                                            <td colspan="3" class="text-center"><strong>Total Harga :</strong></td>
                                            <td colspan="3" class="text-center"><strong>Rp {{ number_format($totalHarga, 0, ',', '.') }}</strong></td>
                                        </tr>
                                    </tfoot> --}}
                                @endif
                            </table>
                        </div>
                    @else
                        <p class="mt-3">Tidak ada data transaksi.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function searchData() {
        document.getElementById('laporanForm').submit();
    }
</script>

@endsection