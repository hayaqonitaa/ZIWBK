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
  
  <!-- Useful features: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container">
    <section id="zonaIntegritas" class="section-py text-center">
    <div class="container">
        <h2>POLBAN Menuju Zona Integritas</h2>
        <p>Transparansi. Akuntabilitas. Kualitas.<br><br><br></p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <h4>Pemerintahan Bersih</h4>
                <p>Mencegah korupsi di setiap lini</p>
                <hr>
            </div>
            <div class="col-md-4">
                <h4>Pelayanan Prima</h4>
                <p>Cepat, tepat, dan profesional</p>
                <hr>
            </div>
            <div class="col-md-4">
                <h4>Akuntabilitas</h4>
                <p>Hasil yang terukur dan transparan</p>
                <hr>
            </div>

            <img src="{{ asset('images/piagam.jpg') }}" alt="piagam" class="img-fluid" style="width: 100vw; height: auto;" />
        </div>
    </div>
</section>
    </div>
  </section>
  <!-- Useful features: End -->

</div>
@endsection
