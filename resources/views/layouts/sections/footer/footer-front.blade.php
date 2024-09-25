<!-- Footer: Start -->
<footer class="landing-footer bg-body footer-text">
  <div class="footer-top position-relative overflow-hidden z-1">
    <img src="{{asset('assets/img/front-pages/backgrounds/footer-bg-'.$configData['style'].'.png')}}" alt="footer bg" class="footer-bg banner-bg-img z-n1" data-app-light-img="front-pages/backgrounds/footer.png" data-app-dark-img="front-pages/backgrounds/footer.png" />
    <div class="container">
      <div class="row gx-0 gy-4 g-md-5">
        <div class="col-5 text-center">
            <!-- <span class="app-brand-logo demo">@include('_partials.macros',['height'=>20,'withbg' => "fill: #fff;"])</span> -->
            <img src="{{ asset('images/logo_footer.png') }}" alt="Deskripsi Gambar" width=270px height=170px></span>
          <p class="footer-title mb-4 text-center">
            Assuring Your Future
          </p>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <h6 class="footer-title mb-4">Demos</h6>
          <ul class="list-unstyled">
            <li class="mb-3">
              <a href="/demo-1" target="_blank" class="footer-link">Agen Perubahan</a>
            </li>
            <li class="mb-3">
              <a href="/demo-5" target="_blank" class="footer-link">Ringkasan Hasil Survey</a>
            </li>
            <li class="mb-3">
              <a href="/demo-2" target="_blank" class="footer-link">Standar Pelayanan</a>
            </li>
            <li class="mb-3">
              <a href="/demo-3" target="_blank" class="footer-link">Tim Kerja</a>
            </li>
          </ul>
        </div>
        <div class="col-lg-2 col-md-4 col-sm-6">
          <h6 class="footer-title mb-4">Download our app</h6>
          <a href="javascript:void(0);" class="d-block footer-link mb-3 pb-2"><img src="{{asset('assets/img/front-pages/landing-page/apple-icon.png')}}" alt="apple icon" /></a>
          <a href="javascript:void(0);" class="d-block footer-link"><img src="{{asset('assets/img/front-pages/landing-page/google-play-icon.png')}}" alt="google play icon" /></a>
        </div>
      </div>
    </div>
  </div>
  <div class="footer-bottom py-3">
    <div class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
      <div class="mb-2 mb-md-0">
        <span class="footer-text">©
          <script>
          document.write(new Date().getFullYear());

          </script>
        </span>
        <a href="{{config('variables.creatorUrl')}}" target="_blank" class="fw-medium text-white footer-link">{{config('variables.creatorName')}},</a>
        <span class="footer-text"> Made with ❤️ for a better web.</span>
      </div>
      <div>
        <a href="{{config('variables.githubFreeUrl')}}" class="footer-link me-3" target="_blank">
          <img src="{{asset('assets/img/front-pages/icons/github-'.$configData['style'].'.png') }}" alt="github icon" data-app-light-img="front-pages/icons/github-light.png" data-app-dark-img="front-pages/icons/github-dark.png" />
        </a>
        <a href="{{config('variables.facebookUrl')}}" class="footer-link me-3" target="_blank">
          <img src="{{asset('assets/img/front-pages/icons/facebook-'.$configData['style'].'.png') }}" alt="facebook icon" data-app-light-img="front-pages/icons/facebook-light.png" data-app-dark-img="front-pages/icons/facebook-dark.png" />
        </a>
        <a href="{{config('variables.twitterUrl')}}" class="footer-link me-3" target="_blank">
          <img src="{{asset('assets/img/front-pages/icons/twitter-'.$configData['style'].'.png') }}" alt="twitter icon" data-app-light-img="front-pages/icons/twitter-light.png" data-app-dark-img="front-pages/icons/twitter-dark.png" />
        </a>
        <a href="{{config('variables.instagramUrl')}}" class="footer-link" target="_blank">
          <img src="{{asset('assets/img/front-pages/icons/instagram-'.$configData['style'].'.png') }}" alt="google icon" data-app-light-img="front-pages/icons/instagram-light.png" data-app-dark-img="front-pages/icons/instagram-dark.png" />
        </a>
      </div>
    </div>
  </div>
</footer>
<!-- Footer: End -->
