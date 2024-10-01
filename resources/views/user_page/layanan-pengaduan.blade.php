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
<style>
  /* Mengatur font dan garis hanya untuk halaman layanan pengaduan */
  #LP h3 {
    font-size: 20px;  
    font-weight: bold; 
    color: #273272; 
    font-family: 'Poppins', sans-serif;
    margin-bottom: 0px; 
  }

  #LP hr {
    width: 100px;
    border: 2px solid #273272; 
    margin: 30px auto;
    margin-top: 0px; 
  }

  /* Hover effect untuk card */
  .card {
    border: 2px solid #d29e9e;
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(166, 21, 21, 0.2);
    border-color: #210407;
  }

  .border-primary {
    border-color: #ba25ab !important;
  }

  /* Menghilangkan underline dari link */
  .card a {
    text-decoration: none;
  }
</style>
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

  <!-- Section for Layanan Pengaduan -->
  <section id="LP" class="section-py landing-features">
    <div class="container-fluid px-0 position-relative">
      <!-- Gambar Full Width SPU -->
      <div class="mb-4 position-relative">
        <img src="{{ asset('images/Polban.png') }}" alt="header SPU" class="img-fluid" style="width: 100vw; height: auto;" />

        <!-- Teks "Layanan Pengaduan" dengan Persegi -->
        <h3 class="position-absolute" style="bottom: 20px; left: 20px; color: white; font-size: 1.5rem; z-index: 10;">
          <!-- Persegi oranye -->
          <span style="display: inline-block; width: 40px; height: 40px; background-color: orange; margin-right: 10px; vertical-align: middle;"></span>
          Layanan Pengaduan
        </h3>
      </div>

      <!-- Judul Layanan Pengaduan dengan Garis Bawah -->
      <div class="container text-center" id="LP">
        <h3 class="mb-4">Layanan Pengaduan</h3>
        <hr>
        
        <!-- Row for the Cards -->
        <div class="row justify-content-center">
          <!-- Stop Gratifikasi Card -->
          <div class="col-sm-6 col-lg-3 mb-4">
            <a href="https://gol.kpk.go.id/login" target="_blank" class="text-decoration-none">
              <div class="card border border-primary shadow-none h-100">
                <div class="card-body text-center">
                  <img src="{{ asset('images/Vector.png') }}" alt="pendidikan" class="mb-2" style="width: 80px; height: auto;" />
                  <h5 class="h5">Stop Gratifikasi</h5>
                </div>
              </div>
            </a>
          </div>

          <!-- SP4N Lapor Card -->
          <div class="col-sm-6 col-lg-3 mb-4">
            <a href="https://www.lapor.go.id" target="_blank" class="text-decoration-none">
              <div class="card border border-primary shadow-none h-100">
                <div class="card-body text-center">
                  <img src="{{ asset('images/Vector2.png') }}" alt="penelitian" class="mb-2" style="width: 80px; height: auto;" />
                  <h5 class="h5">SP4N Lapor</h5>
                </div>
              </div>
            </a>
          </div>

          <!-- Whistleblower Card -->
          <div class="col-sm-6 col-lg-3 mb-4">
            <a href="https://kemdikbud.go.id" target="_blank" class="text-decoration-none">
              <div class="card border border-primary shadow-none h-100">
                <div class="card-body text-center">
                  <img src="{{ asset('images/Vector3.png') }}" alt="pengabdian" class="mb-2" style="width: 80px; height: auto;" />
                  <h5 class="h5">Whistleblower</h5>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
@endsection
