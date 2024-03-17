@extends('admin')
@section('content')
<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-5">
        <br>
        <br>
          <h2 style="color: rgb(18, 58, 122);">Data Pengguna</h2>
        </div>
        <div class="col-sm-6">
        <br>
        <br>
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('dashboard')}}">Dashboard</a></li>
            <li class="breadcrumb-item active">Pengguna Page</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

                
 <div class="table-responsive p-3"> <!-- Add padding to the table -->
    @if($message = Session::get('success'))
      <div class="alert alert-success">{{ $message }}</div>
    @endif
        <a href="{{route('users.create')}}" class="btn btn-inverse-success">Tambah Data</a>
        <br>
        <br>
        <table id="myTable" class="table table-bordered align-items-center mb-0">
           <thead>
                <tr>
                    <th class="text-center" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Nama </th>
                    <th class="text-center" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Username</th>
                    <th class="text-center" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">role</th>
                    <th class="text-center" class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Aksi</th>
                </tr>
            </thead>
        <tbody>
    @foreach ($usersM as $peserta)
                <tr>
                <td class="text-center">{{ $peserta->nama }}</td>
                <td class="text-center">{{ $peserta->username }}</td>
                <td class="text-center">{{ $peserta->role}}</td>  
                 <td>
                  <div class="text-center">
                    <form action="{{ route('users.destroy', $peserta->id) }}" method="POST" style="display: inline-block;">
                        <a href="{{ route('users.edit', $peserta->id) }}" class="btn bts-xs btn-inverse-warning p-2">
                            <i class="icon-file"></i>
                        </a>
                        <a href="{{ route('users.changepassword', $peserta->id) }}" class="btn bts-xs btn-inverse-primary p-2">
                            <i class="icon-lock"></i>
                        </a>
                        @csrf
                        @method('delete')
                
                        <button type="submit" class="btn bts-xs btn-inverse-danger p-2" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?');">
                            <i class="icon-trash"></i>
                        </button>
                    </form>
                </div>
                
                  </td>
                  </tr>
               @endforeach
         </tbody>
     </table>
         </div>
       </div>
    </div>
    </div>
</div>
@endsection
