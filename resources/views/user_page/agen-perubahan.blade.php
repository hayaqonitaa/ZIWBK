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
<section id="agenPerubahan" class="section-py">
    <div class="container-fluid px-0">
        <!-- Gambar Full Width Header -->
        <div class="mb-4 position-relative">
            <img src="{{ asset('images/Polban.png') }}" alt="header image" class="img-fluid" style="width: 100vw; height: auto;" />
            
            <!-- Judul "Tim" di Ujung Bawah Kiri -->
            <h2 class="position-absolute" style="left: 20px; bottom: 20px; color: white; font-family: Poppins; font-size: 28px; font-weight: 600; line-height: 42px; text-align: left;">Tim</h2>
        </div>

        <!-- Judul Agen Perubahan -->
        <h3 class="mb-0" style="color: #07294D; font-family: Poppins; font-size: 28px; font-weight: 600; line-height: 42px; text-align: center; margin-top: 20px;">Agen Perubahan</h3>
        <div style="border-bottom: 2px solid #000; display: inline-block; width: 150px; margin: 5px auto 20px auto;"></div>

        <!-- Rectangle Agen Perubahan -->
        <div class="row justify-content-center mt-4">
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="d-flex align-items-center" style="background-color: #D2DFEC; padding: 20px; border-radius: 100px 20px 20px 100px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); margin-bottom: 30px;">
                    <div class="ellipse" style="width: 100px; height: 100px; background-color: white; border-radius: 50%; overflow: hidden; border: 2px solid #00796B; margin-right: -50px; position: relative; z-index: 1;">
                        <img src="{{ asset('images/rodiah.png') }}" alt="Rodiah" style="width: 100%; height: auto;">
                    </div>
                    <div style="margin-left: 50px; z-index: 0;">
                        <h5 class="mt-0">Rodiah</h5>
                        <p class="mb-0">Tenaga Kependidikan</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-4 mb-4">
                <div class="d-flex align-items-center" style="background-color: #D2DFEC; padding: 20px; border-radius: 100px 20px 20px 100px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);">
                    <div class="ellipse" style="width: 100px; height: 100px; background-color: white; border-radius: 50%; overflow: hidden; border: 2px solid #00796B; margin-right: -50px; position: relative; z-index: 1;">
                        <img src="{{ asset('images/Paula.png') }}" alt="Example" style="width: 100%; height: auto;">
                    </div>
                    <div style="margin-left: 50px; z-index: 0;">
                        <h5 class="mt-0">Nama Lain</h5>
                        <p class="mb-0">Jabatan Lain</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Judul Tim Kerja ZI WBBM -->
        <h3 class="mb-0 mt-5" style="color: #07294D; font-family: Poppins; font-size: 28px; font-weight: 600; line-height: 42px; text-align: center;">Tim Kerja ZI WBBM</h3>
        
        <!-- Foto di Bawah Judul Tim Kerja ZI WBBM -->
        <div class="text-center" style="margin-top: 20px;">
            <img src="{{ asset('images/Tim-Kerja.png') }}" alt="Tim Kerja ZI WBBM" style="width: 60%; height: auto;">
        </div>
    </div>
</section>



</div>
@endsection
