@extends('layouts/layoutMaster')

@section('title', 'Home')

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
    <div class="header-container" style="position: relative; margin-top: 100px;">
        <div class="container-fluid px-0">
            <div class="mb-4">
                <!-- Gambar Header dengan Penanda -->
                <div class="header">
                    <img src="{{ asset('images/Polban.png') }}" alt="headerpolban" class="img-fluid w-100" />

                    <div class="text-box">
                        <!-- Kotak Kuning -->
                        <div class="yellow-box"></div>
                        <!-- Tulisan -->
                        <span class="zi-wbk-text">ZI WBK/WBBM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Content Section -->
<section id="zonaIntegritas" class="section-py text-center">
    <div class="container">
        <h2 class="mb-4">POLBAN Menuju Zona Integritas</h2>
        <p>Transparansi. Akuntabilitas. Kualitas.</p>

        <!-- Three Columns Section -->
        <div class="row mt-4">
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h4>Pemerintahan Bersih</h4>
                <p>Mencegah korupsi <br>di setiap lini</p>
                <hr>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
                <h4>Pelayanan Prima</h4>
                <p>Cepat, tepat, dan <br>profesional</p>
                <hr>
            </div>
            <div class="col-12 col-md-4">
                <h4>Akuntabilitas</h4>
                <p>Hasil yang terukur dan <br>transparan</p>
                <hr>
            </div>
        </div>
    </div>
</section>

<!-- Blue Box Section with bottom margin -->
<div class="container-fluid py-4" style="background-color: #E9EEF4; text-align: center; width: 100%; margin-bottom: 20px;">
    <p class="mb-0" style="color: #003366; font-size: 1.2rem; line-height: 1.5;">
        POLBAN berkomitmen untuk membangun lingkungan yang bersih dari<br>
        korupsi dan memberikan layanan terbaik. Bersama, kita menciptakan sistem<br>
        birokrasi yang efektif dan responsif untuk semua pemangku kepentingan.
    </p>
</div>

<!-- Full-Width Image and Text Section -->
<div class="container my-5">
    <div class="row align-items-center" id="piagamZiwbkWbbm">
        <!-- Text Column: Atur agar muncul di atas gambar pada layar kecil -->
        <div class="col-12 col-md-4 text-center text-md-start order-1 order-md-2">
            <h4>Piagam ZIWBK/WBBM</h4>
        </div>

        <!-- Image Column: Atur agar muncul di bawah teks pada layar kecil -->
        <div class="col-12 col-md-8 order-2 order-md-1">
            <img src="{{ asset('images/piagam.jpg') }}" alt="Piagam" class="img-fluid w-100 mb-3" />
        </div>
    </div>
</div>
@endsection
