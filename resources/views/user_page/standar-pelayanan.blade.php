@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Front Pages')

<!-- Vendor Styles -->
@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/nouislider/nouislider.scss',
  'resources/assets/vendor/libs/swiper/swiper.scss'
])
@endsection

<!-- Page Styles -->
@section('page-style')
@vite(['resources/assets/vendor/scss/pages/front-page-landing.scss'])
@endsection

<!-- Vendor Scripts -->
@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/nouislider/nouislider.js',
  'resources/assets/vendor/libs/swiper/swiper.js'
])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/front-page-landing.js'])
@endsection

@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">

  <!-- Useful Features: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container-fluid px-0">
      <!-- Gambar Full Width SPU -->
      <div class="mb-4">
        <img src="{{ asset('images/spu.png') }}" alt="header SPU" class="img-fluid" style="width: 100vw; height: auto;" />
      </div>

      <!-- Judul Standar Pelayanan -->
      <div class="container text-center">
        <h3 class="mb-4" style="border-bottom: 2px solid #000; display: inline-block;">Standar Pelayanan</h3>
        <div class="row justify-content-center">
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/pendidikan.png') }}" alt="pendidikan" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">Pendidikan</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/penelitian.png') }}" alt="penelitian" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">Penelitian</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/pkm.png') }}" alt="pengabdian" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">Pengabdian Kepada Masyarakat</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/administrasi.png') }}" alt="administrasi" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">Administrasi</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Useful Features: End -->

</div>
@endsection
