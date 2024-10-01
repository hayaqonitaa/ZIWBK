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
<script>
  // JavaScript code goes here
  document.addEventListener('DOMContentLoaded', function() {
    const yearSelect = document.getElementById('yearSelect'); // Ambil elemen dropdown tahun
    const pdfEmbed = document.getElementById('pdfEmbed'); // Ambil elemen embed PDF
    const basePdfPath = "{{ asset('file/hasilsurvey') }}"; // Jalur dasar ke file PDF

    yearSelect.addEventListener('change', function() {
      const selectedYear = yearSelect.value; // Dapatkan nilai tahun yang dipilih
      const pdfSrc = `${basePdfPath}_${selectedYear}.pdf`; // Jalur PDF yang dihasilkan

      // Periksa apakah file PDF ada dengan membuat permintaan fetch
      fetch(pdfSrc)
        .then(response => {
          if (response.ok) {
            pdfEmbed.src = pdfSrc; // Ubah sumber PDF
          } else {
            alert(`PDF untuk tahun ${selectedYear} tidak tersedia.`); // Tampilkan peringatan
            pdfEmbed.src = ''; // Kosongkan sumber PDF
          }
        })
        .catch(() => {
          alert(`PDF untuk tahun ${selectedYear} tidak tersedia.`); // Tampilkan peringatan jika ada kesalahan
          pdfEmbed.src = ''; // Kosongkan sumber PDF
        });
    });
  });
</script>
@endsection

@section('content')
<div data-bs-spy="scroll" class="scrollspy-example">

  <!-- Useful features: Start -->
  <section id="landingFeatures" class="section-py landing-features">
    <div class="container-fluid px-0">
      <!-- Gambar Full Width headerpolban -->
      <div class="mb-4">
        <img src="{{ asset('images/headerpolban.png') }}" alt="header polban" class="img-fluid" style="width: 100vw; height: 400px;" />
      </div>
    </div>

    <!-- header kotak -->
    <div class="container" style="position: absolute; bottom: 150px; left: 50%; transform: translateX(-50%); display: flex; align-items: center;">
      <!-- Kotak Kuning -->
      <div style="background-color: #FFC107; width: 30px; height: 30px; margin-right: 10px;"></div>
      <!-- Tulisan -->
      <span style="color: white; font-weight: bold;">ZI WBK/WBBM</span>
    </div>

    <!-- Judul Standar Pelayanan -->
    <div class="container text-center" id="hasilsurvey">
      <h3 class="mb-4">Hasil Survey</h3>
      <hr>
      <div class="row justify-content-center align-items-start">
        <div class="col-md-8">
          <!-- Embed PDF -->
          <embed id="pdfEmbed" src="{{ asset('file/hasilsurvey_2021.pdf') }}" type="application/pdf" width="100%" height="600px" />
        </div>
        <div class="col-md-4">
          <!-- Dropdown Tahun -->
          <label for="yearSelect" style="font-weight: bold;">Pilih Tahun:</label>
          <select id="yearSelect" class="form-select mb-4">
            <option value="2021">2021</option>
            <option value="2022">2022</option>
            <option value="2023">2023</option>
            <option value="2024">2024</option>
            <!-- Tambahkan opsi tahun sesuai kebutuhan -->
          </select>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection