<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>StyClean'y | {{ $subtitle }}</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{ url('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{ url('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{ url('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" type="text/css" href="{{ url('js/select.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{ url('//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css')}}">
  <link rel="stylesheet" href="{{url('cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css')}}">

  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ url('images/laundry.png')}}" />
</head>
<body>
  <div class="container-scroller">
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-10"><img src="{{url('images/logostyclean.png')}}" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini"><img src="{{url('images/laundry.png')}}" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
          </li>
        </ul>
      </div>
    </nav>
    <div class="container-fluid page-body-wrapper">
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('products')}}">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Paket Laundry</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('transactions')}}">
              <i class="ti-shopping-cart menu-icon"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('users')}}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          <br>
          <li class="nav-item">
            <button class="nav-link" onclick="location.href='{{ url('logout')}}'">
                <i class="ti-shift-left menu-icon"></i>
                <span class="menu-inverse-title">Keluar</span>
            </button>
        </li>
          @endif
          @if(Auth::user()->role == 'kasir')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('products')}}">
              <i class="icon-box menu-icon"></i>
              <span class="menu-title">Paket Laundry</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('transactions')}}">
              <i class="ti-shopping-cart menu-icon"></i>
              <span class="menu-title">Transaksi</span>
            </a>
          </li>
          <br>
          <li class="nav-item">
            <button class="nav-link" onclick="location.href='{{ url('logout')}}'">
                <i class="ti-shift-left menu-icon"></i>
                <span class="menu-inverse-title">Keluar</span>
            </button>
        </li>
          @endif
          @if(Auth::user()->role == 'owner')
          <li class="nav-item">
            <a class="nav-link" href="{{ url('dashboard')}}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
              <i class="ti-agenda menu-icon"></i>
              <span class="menu-title">Laporan</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('laporan')}}">Transaksi</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ url('products')}}">Produk</a></li>
              </ul>
            </div>
          </li>      
          <li class="nav-item">
            <a class="nav-link" href="{{ url('log')}}">
              <i class="icon-clock menu-icon"></i>
              <span class="menu-title">Log</span>
            </a>
          </li>
          <br>
          <li class="nav-item">
            <button class="nav-link" onclick="location.href='{{ url('logout')}}'">
                <i class="ti-shift-left menu-icon"></i>
                <span class="menu-inverse-title">Keluar</span>
            </button>
        </li>
          @endif
        </ul>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        {{-- <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyleft © 2023. Yufa Maryafa. All rights reserved.</span>
          </div>
        </footer> --}}
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{ url('vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{ url('vendors/chart.js/Chart.min.js')}}"></script>
  <script src="{{ url('vendors/datatables.net/jquery.dataTables.js')}}"></script>
  <script src="{{ url('vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{ url('js/dataTables.select.min.js')}}"></script>
  <script src="{{ url('https://code.jquery.com/jquery-3.6.0.min.js')}}"></script>


  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{ url('js/off-canvas.js')}}"></script>
  <script src="{{ url('js/hoverable-collapse.js')}}"></script>
  <script src="{{ url('js/template.js')}}"></script>
  <script src="{{ url('js/settings.js')}}"></script>
  <script src="{{ url('js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ url('js/dashboard.js')}}"></script>
  <script src="{{ url('js/Chart.roundedBarCharts.js')}}"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                integrity="sha256-/JqT3SQfaqRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                crossorigin="anonymous"></script>
  <script src="{{ url('//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js')}}"></script>
  <script type="text/javascript">
    let table = new DataTable('#myTable');
</script>
  <!-- End custom js for this page-->
</body>

</html>
