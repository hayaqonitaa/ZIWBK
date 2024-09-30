@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Landing - Layanan Pengaduan')

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
    <div class="container-fluid px-0 position-relative">
      <!-- Gambar Full Width SPU -->
      <div class="mb-4 position-relative">
        <img src="{{ asset('images/Polban.png') }}" alt="header SPU" class="img-fluid" style="width: 100vw; height: auto;" />

        <!-- Teks "Layanan Pengaduan" dengan Persegi -->
        <h3 class="position-absolute" style="bottom: 20px; left: 20px; color: white; font-size: 2.5rem; z-index: 10;">
          <!-- Persegi oranye -->
          <span style="display: inline-block; width: 40px; height: 40px; background-color: orange; margin-right: 10px; vertical-align: middle;"></span>
          Layanan Pengaduan
        </h3>
      </div>

      <!-- Judul Layanan Pengaduan -->
      <div class="container text-center">
        <h3 class="mb-4" style="border-bottom: 2px solid #000; display: inline-block;">Layanan Pengaduan</h3>
        <div class="row justify-content-center">
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/Vector.png') }}" alt="pendidikan" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">Stop Gratifikasi</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/Vector2.png') }}" alt="penelitian" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">SP4N Lapor</h5>
              </div>
            </div>
          </div>
          <div class="col-sm-6 col-lg-3 mb-4">
            <div class="card border border-primary shadow-none h-100">
              <div class="card-body text-center">
                <img src="{{ asset('images/Vector3.png') }}" alt="pengabdian" class="mb-2" style="width: 80px; height: auto;" />
                <h5 class="h5">Whistleblower</h5>
              </div>
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
