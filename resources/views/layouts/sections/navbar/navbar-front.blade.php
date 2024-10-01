@php
$currentRouteName = Route::currentRouteName();
$activeRoutes = ['front-pages-pricing', 'front-pages-payment', 'front-pages-checkout', 'front-pages-help-center'];
$activeClass = in_array($currentRouteName, $activeRoutes) ? 'active' : '';
@endphp
<!-- Navbar: Start -->
<nav class="layout-navbar shadow-none py-0">
  <div class="container">
    <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
      <!-- Menu logo wrapper: Start -->
      <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
        <button class="navbar-toggler border-0 px-0 me-2" type="button">
          <i class="ti ti-menu-2 ti-sm align-middle"></i>
        </button>
        <a href="{{url('/')}}" class="app-brand-link">
          <span class="app-brand-logo demo"><img src="{{ asset('images/logo.png') }}" alt="Deskripsi Gambar" width=22px height=24px></span>
          <span class="app-brand-text demo menu-text fw-bold">{{ config('variables.templateName') }}</span>
        </a>
      </div>
      <!-- Menu logo wrapper: End -->
      <!-- Menu wrapper: Start -->
      <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto">
          <li class="nav-item">
            <a class="nav-link fw-medium {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('hasil-survey*') ? 'active' : '' }}" href="{{ url('hasil-survey') }}">Hasil Survey</a>
          </li>
          <!-- Dropdown untuk Layanan -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">Layanan</a>
            <div class="dropdown-menu">
            <a class="dropdown-item {{ request()->is('standar-pelayanan*') ? 'active' : '' }}" href="{{ url('standar-pelayanan') }}">Standar Pelayanan</a>
            <a class="dropdown-item {{ request()->is('layanan-pengaduan*') ? 'active' : '' }}" href="{{ url('layanan-pengaduan') }}">Layanan Pengaduan</a>
            </div>
          </li>
          <!-- Dropdown untuk Tim -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">Tim</a>
            <div class="dropdown-menu">
              <a class="dropdown-item {{ request()->is('agen-perubahan*') ? 'active' : '' }}" href="{{ url('agen-perubahan') }}">Agen Perubahan</a>
              <a class="dropdown-item {{ request()->is('tim-kerja*') ? 'active' : '' }}" href="{{ url('tim-kerja') }}">Tim Kerja</a>
            </div>
          </li>
        </ul>
      </div>
      <!-- Menu wrapper: End -->
      <!-- Toolbar: Start -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        <!-- navbar button: Start -->
        <li>
          <a href="{{url('/auth/login-cover')}}" class="btn btn-primary"><span class="tf-icons ti ti-login scaleX-n1-rtl me-md-1"></span><span class="d-none d-md-block">Login</span></a>
        </li>
        <!-- navbar button: End -->
      </ul>
      <!-- Toolbar: End -->
    </div>
  </div>
</nav>
<!-- Navbar: End -->
