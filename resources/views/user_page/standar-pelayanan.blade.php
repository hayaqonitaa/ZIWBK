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
