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

  .img-cover {
    width: 200px;
    height: 300px;
    background-color: white;
    flex-shrink: 0;
    margin-right: 20px;
  }

  .img-wrapper-2 img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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
    <div class="header-container" style="position: relative; margin-top: 100px;">
        <div class="container-fluid px-0">
            <div class="mb-4">
                <!-- Gambar Header dengan Penanda -->
                <div class="header">
                    <img src="{{ asset('images/Polban.png') }}" alt="headerpolban" class="img-fluid" />
                    <div class="text-box">
                        <!-- Kotak Kuning -->
                        <div class="yellow-box"></div>
                        <!-- Tulisan -->
                        <span class="zi-wbk-text">Layanan Pengaduan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Judul Layanan Pengaduan dengan Garis Bawah -->
<div class="container text-center" id="LP">
    <h3 class="mb-4">Layanan Pengaduan</h3>
    <hr>

<!-- Row for the Cards -->
<div class="row justify-content-center">
    <!-- Loop untuk membuat card berdasarkan data dari database -->
    @foreach($contents as $content)
    <div class="col-sm-6 col-lg-3 mb-4">
        <!-- Link utama pada card sekarang menggunakan deskripsi sebagai URL -->
        <a href="{{ $content->deskripsi }}" target="_blank" class="text-decoration-none">
            <div class="card border border-primary shadow-none h-100" style="cursor: pointer;">
                <div class="card-body text-center">
                  <div class="img-cover">
                    <img src="{{ asset('storage/' . $content->deskripsi) }}" alt="{{ $content->judul }}">
                  </div>
                    <h5 class="h5">{{ $content->judul }}</h5>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection
