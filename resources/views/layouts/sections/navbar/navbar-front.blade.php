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
        <!-- Mobile menu toggle: Start-->
        <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="ti ti-menu-2 ti-sm align-middle"></i>
        </button>
        <!-- Mobile menu toggle: End-->
        <a href="{{url('/')}}" class="app-brand-link">
          <span class="app-brand-logo demo"><img src="{{ asset('images/logo.png') }}" alt="Deskripsi Gambar" width=22px height=24px></span>
          <span class="app-brand-text demo menu-text fw-bold">{{ config('variables.templateName') }}</span>
        </a>
      </div>
      <!-- Menu logo wrapper: End -->
      <!-- Menu wrapper: Start -->
      <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
        <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <i class="ti ti-x ti-sm"></i>
        </button>
        <ul class="navbar-nav me-auto">
        <li class="nav-item">
            <a class="nav-link fw-medium {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ url('/') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ request()->is('tim*') ? 'active' : '' }}" href="{{ url('tim') }}">Tim</a>
          </li>
          <!-- Dropdown untuk Layanan -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#">Layanan</a>
            <div class="dropdown-menu">
            <a class="dropdown-item {{ request()->is('standar-pelayanan*') ? 'active' : '' }}" href="{{ url('standar-pelayanan') }}">Standar Pelayanan</a>
            <a class="dropdown-item {{ request()->is('layanan-pengaduan*') ? 'active' : '' }}" href="{{ url('layanan-pengaduan') }}">Layanan Pengaduan</a>
            </div>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link fw-medium" href="{{url('front-pages/landing')}}#landingTeam">Team</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-medium" href="{{url('front-pages/landing')}}#landingFAQ">FAQ</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link fw-medium" href="{{url('front-pages/landing')}}#landingContact">Contact us</a>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link fw-medium" href="{{url('/')}}" target="_blank">Admin</a>
          </li> -->
        </ul>
      </div>
      <div class="landing-menu-overlay d-lg-none"></div>
      <!-- Menu wrapper: End -->
      <!-- Toolbar: Start -->
      <ul class="navbar-nav flex-row align-items-center ms-auto">
        @if($configData['hasCustomizer'] == true)
        <!-- Style Switcher -->
        <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
          <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
            <i class='ti ti-sm'></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
              </a>
            </li>
          </ul>
        </li>
        <!-- / Style Switcher-->
        @endif
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

