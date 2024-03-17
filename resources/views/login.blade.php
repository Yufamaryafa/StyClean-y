<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>StyClean'y</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{url('vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{url('vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{url('vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{url('css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('images/laundry.png')}}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="{{url('images/logoosty.png')}}" alt="logo">
              </div>
              {{-- <h4>Hello! let's get started</h4>
              <h6 class="font-weight-light">Sign in to continue.</h6> --}}

              @if(session('success'))
              <p class="alert alert-success">{{ session('success') }}</p>
              @endif
              @if($errors->any())
              @foreach($errors->all() as $err)
              <p class="alert alert-denger">{{ $err }}</p>
              @endforeach
              @endif

              <form action="{{ route('login.action') }}" method="POST">
                @csrf              
              <form class="pt-3">
                <div class="form-group">
                  <input name="username" value="{{ old('username')}}" type="username" class="form-control" id="" placeholder="Username">
                </div>
                <div class="form-group">
                  <input name="password" type="password" class="form-control" id="passwordField" placeholder="Password">
                </div>
                <div class="form-check form-switch d-flex align-items-center mb-1">
                  <input class="form-check-input col-sm-2" type="checkbox" id="showPassword">
                  <label class="form-check-label col-ms-3" for="showPassword">Show Password</label>
                </div>
                <div class="mt-3">
                  <button type="submit" class="btn btn-inverse-info btn-block">Login</button>
                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
                  <div class="form-check">
                  </div>
                </div>
                <div class="mb-2">
                </div>
              </form>
            </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{url('vendors/js/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{url('js/off-canvas.js')}}"></script>
  <script src="{{url('js/hoverable-collapse.js')}}"></script>
  <script src="{{url('js/template.js')}}"></script>
  <script src="{{url('js/settings.js')}}"></script>
  <script src="{{url('js/todolist.js')}}"></script>
  <script>
    const showPasswordCheckbox = document.getElementById('showPassword');
  const passwordField = document.getElementById('passwordField');

  showPasswordCheckbox.addEventListener('change', function () {
    if (this.checked) {
      passwordField.type = 'text'; // Show the password
    } else {
      passwordField.type = 'password'; // Hide the password
    }
  });
  </script>
  <!-- endinject -->
</body>

</html>
