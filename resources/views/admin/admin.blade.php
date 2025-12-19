<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="icon" href="{{ asset('assets/skolafit-removebg-preview.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/fonts/boxicons.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/core.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/css/theme-default.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/demo.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/admin-custom.css') }}">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}">

    @stack('style')

    <script src="{{ asset('/assets/vendor/js/helpers.js') }}"></script>
    <script src="{{ asset('/assets/js/config.js') }}"></script>
</head>

<body>

<div class="layout-wrapper layout-content-navbar">
  <div class="layout-container">

    {{-- SIDEBAR --}}
    @include('admin.sidebar')

    <div class="layout-page">

      {{-- NAVBAR --}}
      @include('admin.navbar')

      {{-- CONTENT --}}
      <div class="content-wrapper">
        @yield('content')

        {{-- FOOTER --}}
        @include('admin.footer')
      </div>

    </div>
  </div>
</div>

<!-- JS -->
<script src="{{ asset('/assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('/assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('/assets/vendor/js/menu.js') }}"></script>
<script src="{{ asset('/assets/js/main.js') }}"></script>

@stack('script')

</body>
</html>
