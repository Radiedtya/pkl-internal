<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin | Dashboard</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/skolafit-removebg-preview.png') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/pages/page-auth.css') }}" />
    <!-- Helpers -->
    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('/assets/js/config.js') }}"></script>
</head>
<body>
    
    
<!-- Content -->
<div class="container-xxl container-p-y">

  <!-- Welcome Card -->
  <div class="row">
    <div class="col-lg-12 mb-4 order-0">
      <div class="card">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h2 class="card-title text-primary">
                Selamat Datang, {{ Auth::user()->name ?? 'User' }} 👋
              </h2>
              <p class="text-muted">
                <i>
                  Kamu berhasil login ke sistem. Semangat berkarya dan lanjutkan aktivitasmu hari ini!  
                  Jangan lupa, kalau ada yang mau kamu kelola atau update, gas aja — semuanya udah siap membantu aktivitasmu.  
                  Have a productive day, bro!
                </i>
              </p>

              <div class="text-primary mt-4">
                <span><i class="bi bi-clock-history"></i> Login terakhir : 
                  <strong>{{ now()->format('d-M-Y, H:i') }}</strong>
                </span><br>
                <span><i class="bi bi-laptop"></i> Sistem : <strong>v1.0</strong></span><br>
                <span><i class="bi bi-shield-check"></i> Status : <strong>Aktif</strong></span>
              </div>
            </div>
          </div>

          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 px-0 px-md-4">
              <img src="{{ asset('/assets/img/illustrations/man-with-laptop-light.png') }}"
                   height="150"
                   alt="User Illustration"
                   class="img-fluid animated fadeIn"
                   data-app-dark-img="illustrations/man-with-laptop-dark.png"
                   data-app-light-img="illustrations/man-with-laptop-light.png" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Stats Section -->
  <div class="row">
    <div class="col-md-4 col-sm-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body d-flex align-items-center">
          <div class="me-3">
            <span class="badge bg-primary p-3 rounded">
              <i class="bi bi-people fs-4"></i>
            </span>
          </div>
          <div>
            <h5 class="card-title mb-1">Total Pengguna</h5>
            <h3 class="fw-bold text-primary">{{ \App\Models\User::count() }}</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body d-flex align-items-center">
          <div class="me-3">
            <span class="badge bg-success p-3 rounded">
              <i class="bi bi-check-circle fs-4"></i>
            </span>
          </div>
          <div>
            <h5 class="card-title mb-1">Status Akun</h5>
            <h3 class="fw-bold text-success">Verified</h3>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4 col-sm-6 mb-4">
      <div class="card border-0 shadow-sm h-100">
        <div class="card-body d-flex align-items-center">
          <div class="me-3">
            <span class="badge bg-warning p-3 rounded">
              <i class="bi bi-bar-chart fs-4"></i>
            </span>
          </div>
          <div>
            <h5 class="card-title mb-1">Level Akses</h5>
            <h3 class="fw-bold text-warning">{{ Auth::user()->role ?? 'User' }}</h3>
          </div>
        </div>
      </div>
    </div>
  </div>


</div>
<!-- / Content -->

<style>
  .tool-icon {
    width: 80px;
    height: 80px;
    transition: 0.2s ease;
  }
  .tool-icon:hover {
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
  }
</style>




</body>
</html>