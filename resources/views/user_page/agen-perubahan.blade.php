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

<!-- Judul Agen Perubahan -->
<div class="container text-center" id="agenPerubahan">
    <h3 class="mb-4">Agen Perubahan</h3>
    <hr>
    
    <!-- Row for the Cards -->
    <div class="row justify-content-center">
        <div class="col-sm-6 col-md-4 mb-4">
            <div class="d-flex align-items-center" style="background-color: #D2DFEC; padding: 20px; border-radius: 100px 20px 20px 100px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin-bottom: 30px;">
                <div class="ellipse" style="width: 100px; height: 100px; background-color: white; border-radius: 50%; overflow: hidden; border: 2px solid #00796B; margin-right: -50px; position: relative; z-index: 1; display: flex; align-items: center; justify-content: center;">
                    <img src="{{ asset('images/rodiah.png') }}" alt="Rodiah" style="width: 90%; height: auto; object-fit: cover; position: relative; top: -10px; left: -10px; transform: scale(1.2);">
                </div>
                <div style="margin-left: 30px; z-index: 0; text-align: center; flex-grow: 1;">
                    <h5 class="mt-0" style="font-family: Poppins; font-weight: 600; font-size: 24px; color: #110F0F; margin-bottom: 0;">Rodiah</h5>
                    <p class="mb-0" style="font-family: Poppins; font-weight: 600; font-size: 16px; color: #443030;">Tenaga Kependidikan</p>
                </div>
            </div>
        </div>

        <div class="col-sm-6 col-md-4 mb-4">
            <div class="d-flex align-items-center" style="background-color: #D2DFEC; padding: 20px; border-radius: 100px 20px 20px 100px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
                <div class="ellipse" style="width: 100px; height: 100px; background-color: white; border-radius: 50%; overflow: hidden; border: 2px solid #00796B; margin-right: -50px; position: relative; z-index: 1;">
                    <img src="{{ asset('images/Paula.png') }}" alt="Dr. IR. Paula Santi Rudati, M.si" style="width: 100%; height: auto;">
                </div>
                <div style="margin-left: 30px; z-index: 0; text-align: center; flex-grow: 1;">
                    <h5 class="mt-0" style="font-family: Poppins; font-weight: 600; font-size: 20px; color: #110F0F; margin-bottom: 0;">Dr. IR. Paula Santi Rudati, M.si</h5>
                    <p class="mb-0" style="font-family: Poppins; font-weight: 600; font-size: 12px; color: #443030;">Wakil Direktur Bidang Perencanaan dan Sistem Informasi (Dosen)</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Judul Tim Kerja ZI WBBM -->
    <h3 class="mb-0 mt-5" style="color: #07294D; font-family: Poppins; font-size: 22px; font-weight: 600; line-height: 42px; text-align: center;">Tim Kerja ZI WBBM</h3>
    <hr>

    <!-- Embed PDF -->
    <div id="pdfContainer">
        <embed id="pdfEmbed" src="{{ asset('file/0154-SK-Tim-Kerja-Pembangunan-ZI-WBBM.pdf') }}" type="application/pdf" />
    </div>
</div>
@endsection
