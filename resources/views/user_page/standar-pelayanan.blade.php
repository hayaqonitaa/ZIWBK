@extends('layouts/layoutMaster')
@import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap');
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
        <img src="{{ asset('images/standar-pelayanan.png') }}" alt="header SPU" class="img-fluid" style="width: 100vw; height: auto;" />
      </div>

      <!-- Judul Standar Pelayanan -->
      <div class="container text-center" id="SPU">
        <h3 class="mb-4">Standar Pelayanan</h3>
        <hr> 
        <div class="row justify-content-center">

              <!-- Salinan Kepmen Nomor 433/M/2021 -->
      <div class="col-sm-6 col-lg-3 mb-4" id="SalinanKepmenNo433tahun2021">
      <a href="{{ asset('file/SalinanKepmenNo433tahun2021.pdf') }}" target="_blank">
          <div class="card border border-primary shadow-none h-100">
            <div class="card-body text-center">
              <img src="{{ asset('images/pendidikan.png') }}" alt="pendidikan" class="mb-2" style="width: 80px; height: auto;" />
              <h5 class="h5">Salinan Kepmen Nomor 433/M/2021</h5>
            </div>
          </div>
        </a>
      </div>

          <!-- Standar Pelayanan Publik -->
          <div class="col-sm-6 col-lg-3 mb-4">
          <a href="{{ asset('file/standarpelayananpublik.pdf') }}" target="_blank">
              <div class="card border border-primary shadow-none h-100">
                <div class="card-body text-center">
                  <img src="{{ asset('images/pkm.png') }}" alt="pengabdian" class="mb-2" style="width: 80px; height: auto;" />
                  <h5 class="h5">Standar Pelayanan Publik</h5>
                </div>
              </div>
            </a>
          </div>

          <!-- SK Maklumat Pelayanan Publik -->
          <div class="col-sm-6 col-lg-3 mb-4">
            <a href="{{ asset('file/SKMaklumatPelayananPublik.pdf') }}" target="_blank">
              <div class="card border border-primary shadow-none h-100">
                <div class="card-body text-center">
                  <img src="{{ asset('images/administrasi.png') }}" alt="administrasi" class="mb-2" style="width: 80px; height: auto;" />
                  <h5 class="h5">SK Maklumat Pelayanan Publik</h5>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Useful Features: End -->

</div>
@endsection
