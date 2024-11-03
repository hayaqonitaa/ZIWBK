@extends('layouts/layoutMaster')

@section('title', 'Landing - Agen Perubahan')

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
  /* Mengatur font dan garis untuk halaman agen perubahan */
  body {
    font-family: 'Poppins', sans-serif;
  }

  #agenPerubahan h3 {
    font-size: 20px;
    font-weight: bold;
    color: #273272;
    margin-bottom: 10px;
  }

  #agenPerubahan hr {
    width: 100px;
    border: 2px solid #273272;
    margin: 0 auto 30px auto;
  }

  /* Mengatur posisi PDF agar rata horizontal */
  #pdfContainer {
    display: flex;
    justify-content: center;
    margin-top: 20px;
  }

  /* Mengatur ukuran embed PDF */
  #pdfEmbed {
    width: 80%;
    max-width: 900px;
    height: 600px;
  }

  /* Mengatur hover effect pada card */
  .card {
    border: 2px solid #d29e9e;
    transition: all 0.3s ease;
  }

  .card:hover {
    transform: scale(1.05);
    box-shadow: 0 4px 8px rgba(166, 21, 21, 0.2);
    border-color: #210407;
  }

  /* Mengatur margin untuk rectangle */
  .rectangle-container {
    margin-bottom: 40px;
  }

  /* Menghilangkan underline dari link */
  .card a {
    text-decoration: none;
  }

/* Gaya untuk card container */
.card-container {
  display: flex;
  align-items: center;
  background-color: #D2DFEC;
  padding: 20px;
  border-radius: 100px 20px 20px 100px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
  margin-bottom: 30px;
}

/* Responsive styling for one column on smaller screens */
@media (max-width: 768px) {
  .row .col-sm-6.col-md-4 {
    flex: 0 0 100%; /* Set width to 100% */
    max-width: 100%; /* Set max-width to 100% */
  }
}


  /* Gaya untuk gambar dalam card */
  .img-wrapper {
    width: 100px;
    height: 100px;
    border-radius: 50%;
    overflow: hidden;
    background-color: white;
    border: 2px solid #00796B;
    flex-shrink: 0;
    margin-right: -40px;
  }

  .img-wrapper img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  /* Gaya untuk teks dalam card */
  .text-wrapper {
    margin-left: 43px;
    text-align: center;
    flex-grow: 1;
  }

  .text-wrapper h5 {
    font-family: 'Poppins';
    font-weight: 300;
    font-size: 16px;
    color: #110F0F;
    margin-bottom: 0;
  }

  .text-wrapper p {
    font-family: 'Poppins';
    font-weight: 200;
    font-size: 13px;
    margin-left: 10px; 
    color: #443030;
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
                        <span class="zi-wbk-text">Tim Agen Perubahan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div data-bs-spy="scroll" class="scrollspy-example">
    <!-- Judul Agen Perubahan -->
    <div class="container text-center" id="agenPerubahan">
        <h3 class="mb-4">Agen Perubahan</h3>
        <hr>
        
        <!-- Row for the Cards -->
        <div class="row justify-content-center">
            @foreach($contents as $content)
                <div class="col-sm-6 col-md-4 mb-4">
                    <div class="card-container">
                        <div class="img-wrapper">
                            <img src="{{ asset('storage/' . $content->file) }}" alt="{{ $content->judul }}">
                        </div>
                        <div class="text-wrapper">
                            <h5 class="mt-0">{{ $content->judul }}</h5>
                            <p class="mb-0">{{ $content->deskripsi }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
