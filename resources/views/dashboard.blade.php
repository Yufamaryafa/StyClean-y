@extends('admin')
@section('content')

<div class="content-wrapper">
    <div class="row">
      <div class="col-md-12 grid-margin">
        <div class="row">
          <div class="col-12 col-xl-8 mb-4 mb-xl-0">
            {{-- @auth
            <span class="d-sm-inline d-none" style="color: white;">{{ Auth::user()->name }} sebagai {{ Auth::user()->role }}</span>
          @endauth   --}}
            <h3 class="font-weight-bold">Selamat Datang, {{ Auth::user()->nama }}!</h3>
            <h4 class="font-weight-normal mb-0">-{{ Auth::user()->role }}-</h4>
          </div>
          <div class="col-12 col-xl-4">
           <div class="justify-content-end d-flex">
              <button class="btn btn-sm btn-light bg-white" type="button">
               <i class="ti-calendar"></i> {{$formattedDate}}
              </button>
           </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 grid-margin stretch-card">
        <div class="card tale-bg">
          <div class="card-people mt-auto">
            <img src="images/dashboard/people.svg" alt="people">
            <div class="weather-info"> 
              <div class="d-flex">
                <div>
                  {{-- <h2 class="mb-0 font-weight-normal" id="temperature"><i class="icon-sun mr-2"><sup>{{$temperature}}</sup>C</i></h2>
                </div>
                <div class="ms-2">
                  <h4 class="location font-weight-normal" id="city">{{$city}}</h4>
                  <h6 class="font-weight-normal" id="country">{{$negara}}</h6> --}}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    
      <div class="col-md-6 grid-margin transparent">
        <div class="row">
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-tale">
              <div class="card-body">
                <p class="mb-4">Pengguna</p>
                <p class="fs-30 mb-2">{{ $users }}</p>
                <p>Total Pengguna</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 mb-4 stretch-card transparent">
            <div class="card card-dark-blue">
              <div class="card-body">
                <p class="mb-4">Produk</p>
                <p class="fs-30 mb-2">{{ $products}}</p>
                <p>Total Produk</p>
               
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
            <div class="card card-light-blue">
              <div class="card-body">
                <p class="mb-4">Transaksi</p>
                <p class="fs-30 mb-2">{{count($transaksi)}}</p>
                <p>Total Transaksi</p>
              </div>
            </div>
          </div>
          <div class="col-md-6 stretch-card transparent">
            <div class="card card-light-danger">
              <div class="card-body">
                <p class="mb-4">Income</p>
                <p class="fs-30 mb-2">Rp {{ number_format($income, 0, ',', ',') }}</p>
                <p>Total Pendapatan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    @if(Auth::user()->role == 'kasir')
    <div class="row">
      <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <p class="card-title mb-0">Transactions</p>
            <br>
            <div class="table-responsive">
              <table id="myTable" class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-center">Nama Pelanggan</th>
                    <th class="text-center">Est Selesai</th>
                    <th class="text-center">Status Pembayaran</th>
                    <th class="text-center">Status Pengerjaan</th>
                  </tr>  
                </thead>
                <tbody>
            @foreach ($transaksi as $t)
        <tr>
            <td class="text-center">{{ $t->nama_pelanggan }}</td>
            <td class="text-center">
                {{ date('l, d F Y', strtotime($t->est_selesai)) }}
            </td>
            <td class="text-center">
                @if ($t->pembayaran == 'Lunas')
                    <span class="badge badge-success">Lunas</span>
                @elseif ($t->pembayaran == 'Belum Lunas')
                    <span class="badge badge-danger">Belum Lunas</span>
                @endif
            </td>
            <td class="text-center">
                @if ($t->status_pengerjaan == 'Baru')
                    <span class="badge badge-info">Baru</span>
                @elseif ($t->status_pengerjaan == 'Proses')
                    <span class="badge badge-warning">Proses</span>
                @elseif ($t->status_pengerjaan == 'Selesai')
                    <span class="badge badge-primary">Selesai</span>
                @elseif ($t->status_pengerjaan == 'Diambil')
                    <span class="badge badge-success">Diambil</span>
                @endif
            </td>
        </tr>
             @endforeach
                </tbody>
              </table>              
            </div>
          </div>
        </div>
      </div>    
   @endif
  </div>
 @endsection