@extends('admin')
@section('content')
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
          <br>
          <br>
          <h2 style="color: rgb(18, 58, 122);">History Users</h2>
        </div>
        <div class="col-sm-6">
          <br>
          <br>
          <ol class="breadcrumb float-sm-right bg-inverse-primary">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Log Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  {{-- Main content --}}
  <section class="content">

  <div class="table-responsive p-3">
       <br>
        <br>

        <table id="myTable" class="table table-bordered align-items-center mb-0">
            <thead>
              <tr>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Role</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Aktivitas</th>
                <th class=" text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Tanggal</th>
              </tr>
            </thead>
              <tbody>
                @foreach ($logM as $peserta)
                <tr>
                    <td class="text-center">{{ $peserta->nama }}</td>
                    <td class="text-center">{{ $peserta->role }}</td>
                    <td class="text-center">{{ $peserta->activity }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($peserta->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>

  </section>
@endsection