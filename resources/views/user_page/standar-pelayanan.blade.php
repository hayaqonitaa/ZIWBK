@extends('layouts/layoutMaster')

@section('title', 'Standar Pelayanan')

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
                    <img src="{{ asset('images/standar-pelayanan.png') }}" alt="headerpolban" class="img-fluid" />
                    <div class="text-box">
                        <!-- Kotak Kuning -->
                        <div class="yellow-box"></div>
                        <!-- Tulisan -->
                        <span class="zi-wbk-text">STANDAR PELAYANAN</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Judul Standar Pelayanan -->
<div class="container text-center" id="SPU">
    <h3 class="mb-4">Standar Pelayanan</h3>
    <hr> 
    <div class="row justify-content-center">
        <!-- Loop untuk Standar Pelayanan -->
        @foreach($contents as $content)
            <div class="col-sm-6 col-lg-3 mb-4">
                <!-- Card dengan link ke PDF -->
                <a href="{{ asset('storage/' . $content->file) }}" target="_blank" class="text-decoration-none">
                    <div class="card border border-primary shadow-none h-100">
                        <div class="card-body text-center">
                            <img src="{{ asset('storage/' . $content->deskripsi) }}" alt="{{ $content->judul }}" class="mb-2" style="width: 80px; height: auto;" />
                            <h5 class="h5">{{ $content->judul }}</h5>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
@endsection
