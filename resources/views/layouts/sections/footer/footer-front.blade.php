<!-- Footer: Start -->
<footer class="landing-footer bg-body footer-text">
  <div class="footer-top position-relative overflow-hidden z-1">
    <img src="{{asset('assets/img/front-pages/backgrounds/footer-bg-'.$configData['style'].'.png')}}" alt="footer bg" class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer.png" data-app-dark-img="front-pages/backgrounds/footer.png" />
    <div class="container">
      <div class="d-flex align-items-center justify-content-between">

        <!-- Logo dan Tagline -->
        <div class="text-center" style="flex: 1;">
            <img src="{{ asset('images/logo_footer.png') }}" alt="Deskripsi Gambar" width="270" height="170">
            <p class="footer-title mb-4">Assuring Your Future</p>
        </div>

        <!-- Garis Vertikal -->
        <div style="border-left: 1px solid white; height: 200px; margin: 0 50px;"></div>

        <!-- Links dengan Align Left -->
        <div style="flex: 1; text-align: left;">
          <ul class="list-unstyled">
              <li class="mb-2">
                <a href="{{ url('agen-perubahan') }}" target="_blank" class="footer-link">Agen Perubahan</a>
              </li>
              <li class="mb-2">
                <a href="{{ url('hasil-survey') }}" target="_blank" class="footer-link">Ringkasan Hasil Survey</a>
              </li>
              <li class="mb-2">
                <a href="{{ url('standar-pelayanan') }}" target="_blank" class="footer-link">Standar Pelayanan</a>
              </li>
              <li class="mb-2">
                <a href="{{ url('layanan-pengaduan') }}" target="_blank" class="footer-link">Layanan Pengaduan</a>
              </li>
              <li class="mb-2">
                <a href="{{ url('tim-kerja') }}" target="_blank" class="footer-link">Tim Kerja</a>
              </li>
          </ul>
        </div>

        <!-- Garis Vertikal -->
        <div style="border-left: 1px solid white; height: 200px; margin: 0 20px;"></div>

        <!-- Informasi Kontak dan Media Sosial dengan Align Left -->
        <div style="flex: 1; text-align: left;">
          <p class="text-white mb-2">Politeknik Negeri Bandung</p>
          <p class="text-white mb-2">Jawa Barat 40559</p>
          <p class="text-white mb-2">Indonesia <br><br></p>
          <div class="social-links">
            <a href="https://www.instagram.com/politekniknegeribandung/" class="me-3">
              <img src="{{asset('images/instagram.png')}}" alt="Instagram" width="24">
            </a>
            <a href="https://www.facebook.com/polbanofficial/" class="me-3">
              <img src="{{asset('images/facebook.png')}}" alt="Facebook" width="24">
            </a>
            <a href="https://www.youtube.com/channel/UCdRxGHXVIJLCNXmxbeHWtUw?sub_confirmation=1">
              <img src="{{asset('images/youtube.png')}}" alt="YouTube" width="24">
            </a>
          </div>
        </div>

      </div>
    </div>
  </div>
</footer>
<!-- Footer: End -->
