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
@vite([
    'resources/assets/vendor/scss/pages/ui-carousel.scss',
    'resources/assets/vendor/scss/pages/front-page-landing.scss'
])
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
@vite([
    'resources/assets/js/ui-carousel.js',
    'resources/assets/js/front-page-landing.js'
])
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
                        <div class="yellow-box"></div>
                        <span class="zi-wbk-text">ZI WBK/WBBM</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Zona Integritas Section -->
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

<!-- Blue Box Section -->
<div class="container-fluid py-4" style="background-color: #E9EEF4; text-align: center; width: 100%; margin-bottom: 20px;">
    <p class="mb-0" style="color: #003366; font-size: 1.2rem; line-height: 1.5;">
        POLBAN berkomitmen untuk membangun lingkungan yang bersih dari<br>
        korupsi dan memberikan layanan terbaik. Bersama, kita menciptakan sistem<br>
        birokrasi yang efektif dan responsif untuk semua pemangku kepentingan.
    </p>
</div>

<!-- Piagam Section -->
<div class="container my-5">
    @foreach($piagamContents as $content)
    <div class="row align-items-center mb-4" id="piagamZiwbkWbbm">
        <!-- Text Column -->
        <div class="col-12 col-md-4 text-center text-md-start order-1 order-md-2">
            <h4>{{ $content->judul }}</h4>
        </div>
        <!-- Image Column -->
        <div class="col-12 col-md-8 order-2 order-md-1">
            <img src="{{ asset('storage/' . $content->file) }}" alt="Piagam" class="img-fluid w-100 mb-3" />
        </div>
    </div>
    @endforeach
</div>

<!-- Berita Section -->
<section id="berita-carousel" class="section-py">
<div class="container text-center" id="SPU">
    <h3 class="mb-4">Berita ZIWBK/WBBM</h3>
    <hr> 
    <div class="row justify-content-center">
        <div id="beritaCarousel" class="carousel slide position-relative" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($beritaContents->chunk(4) as $chunk) <!-- Kelompokkan per 4 card -->
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <div class="row">
                        @foreach($chunk as $content)
                        <div class="col-md-3">
                            <div class="card h-100 shadow-sm">
                                <img src="{{ asset('storage/' . $content->file) }}" alt="{{ $content->judul }}" class="card-img-top img-fluid" style="height: 200px; object-fit: cover;" />
                                <div class="card-body bg-white">
                                    <h5 class="card-title">{{ $content->judul }}</h5>
                                    <p class="card-text text-truncate">{{ Str::limit($content->deskripsi, 100, '...') }}</p>
                                    <a href="{{ $content->link }}" target="_blank" class="btn btn-primary mt-auto">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <!-- Navigation -->
            <button class="carousel-control-prev custom-carousel-control" type="button" data-bs-target="#beritaCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next custom-carousel-control" type="button" data-bs-target="#beritaCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>


@endsection
