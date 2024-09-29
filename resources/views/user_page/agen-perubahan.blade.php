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

  <!-- Full-Width Header Image Section: Start -->
  <section id="headerImage" class="section-py landing-features" style="position: relative; height: 500px;">
    <div style="
      background-image: url('{{ asset('assets/img/elements/Polban.png') }}');
      background-size: cover;
      background-position: center;
      height: 100%;
      width: 100%;
      position: absolute;
      top: 0;
      left: 0;
      z-index: -1;
    "></div>
    <div style="
      position: absolute;
      top: 50%; /* Vertikal tengah */
      left: 0; /* Kiri ujung */
      transform: translateY(-50%); /* Vertikal tengah secara tepat */
      color: white; /* Warna teks putih */
      font-size: 2rem; /* Ukuran font */
      padding: 0 20px; /* Padding kiri dan kanan jika diperlukan */
      z-index: 1; /* Pastikan teks berada di atas background */
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6); /* Efek bayangan teks */
    ">
      <h2>Agen Perubahan</h2>
    </div>
  </section>
  <!-- Full-Width Header Image Section: End -->

  <!-- Useful features: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container">
        <h1>Halo</h1>
        <h6 class="pb-1 mb-4 text-muted">Grid Card</h6>
        <div class="row row-cols-1 row-cols-md-3 g-1 mb-5">
          <div class="col">
            <div class="card h-5">
              <img class="card-img-top" src="{{asset('assets/img/elements/17.jpg')}}" alt="Card Image" />
              <div class="card-body">
                <h5 class="card-title">Card title</h5>
                <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
              </div>
            </div>
          </div>
        </div>
    </div>
  </section>
  <!-- Useful features: End -->

</div>
@endsection
