@extends('admin')
@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
          <br>
          <br>
          <h2 style="color: rgb(18, 58, 122);">Data Transaksi</h2>
        </div>
        
        <div class="col-sm-6">
            <br>
            <br>
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Transaksi Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  {{-- Main content --}}
<section class="content">

  <div class="table-responsive p-3"> <!-- Add padding to the table -->
    @if($message = Session::get('success'))
    <div class="alert alert-success">{{ $message }}</div>
    @endif
    @if (Auth::user()->role == 'kasir')
    <a href="{{route('transactions.create')}}" class="btn btn-inverse-success">Tambah Data</a>
    <br>
    @endif
    {{-- @if (Auth::user()->role == 'owner')
    <a href="{{url('transactions/all')}}" class="btn btn-inverse-primary">Print Laporan</a>
    @endif --}}
    <br>
    {{-- @if (Auth::user()->role == 'kasir') --}}
    {{-- <a href="{{route('transactions.create')}}" class="btn btn-success">Tambah Data</a>
    <a href="{{url('transaction/all')}}" class="btn btn-warning">Print</a> --}}
    {{-- <a href="" class="btn btn-warning">Prin</a> --}}
    <br>
    {{-- @endif --}}

         <table id="myTable" class="table table-bordered align-items-center mb-0">
            <thead>
                <tr>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">No<br><br>Unik</th>
                    <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama<br><br>Pelanggan</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Paket<br><br>Laundry</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Harga</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Uang<br><br>Bayar</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Uang<br><br>Kembali</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status<br><br>Bayar</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Perkiraan<br><br>Selesai</th>
                    <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Status<br><br>Pengerjaan</th>
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
                @if (count($transactionsM) > 0)
                @foreach ($transactionsM as $peserta)
                <tr>
                  <td class="text-center">{{ $peserta->nomor_unik }}</td>
                  <td class="text-center">{{ $peserta->nama_pelanggan }}</td>
                  <td style="text-align: center;">
                    {{ $peserta->products->nama_produk }} {{ $peserta->products->min_berat}} <br>
                    {{ $peserta->products->ket }}
                  </td>
                  <td class="text-center">{{ number_format($peserta->products->harga_produk, 0, ',', ',') }}</td>
                  <td class="text-center">{{ number_format($peserta->uang_bayar, 0, ',', ',')}}</td>
                  <td class="text-center">{{ number_format($peserta->uang_kembali, 0, ',', ',')}}</td>
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
                    @if (Auth::user()->role !== 'owner')
                    <td class="text-center">
                        <form action="{{route('transactions.destroy', $peserta->id)}}" method="POST">
                            @if (Auth::user()->role == 'kasir')
                            <a href="{{route('transactions.edit', $peserta->id)}}" class="btn btn-xs btn-inverse-warning p-2">
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
                            <a href="{{ route('transactions.generateStruk', $peserta->id) }}" class="btn btn-inverse-success p-2">Lihat Struk</a>
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
@endsection

