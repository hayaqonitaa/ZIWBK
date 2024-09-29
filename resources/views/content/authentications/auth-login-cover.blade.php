@php
$customizerHidden = 'customizer-hide';
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('page-style')
@vite([
  'resources/assets/vendor/scss/pages/page-auth.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/pages-auth.js'
])
@endsection

@section('content')
<div class="authentication-wrapper authentication-cover authentication-bg">
  <div class="authentication-inner row">
    <!-- /Left Text -->
    <div class="d-none d-lg-flex col-lg-7 p-0">
      <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
        <img src="{{ asset('images/login.png') }}" alt="Deskripsi Gambar">
      </div>
    </div>
    <!-- /Left Text -->

    <!-- Login -->
    <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
      <div class="w-px-400 mx-auto">
        <!-- Logo -->
        <div class="app-brand mb-4">
          <a href="{{url('/')}}" class="app-brand-link gap-2">
            <span class="app-brand-logo demo"><img src="{{ asset('images/logo.png') }}" alt="Deskripsi Gambar" width=35px height=37px></span>
          </a>
        </div>
        <!-- /Logo -->
        <h3 class=" mb-1">Welcome to {{config('variables.templateName')}}</h3>
        <p class="mb-4">Sign-in</p>

        <form id="formAuthentication" class="mb-3" action="{{ route('auth-login') }}" method="POST">
  @csrf
  <div class="mb-3">
    <label for="email" class="form-label">Email or Username</label>
    <input type="text" class="form-control" id="email" name="email-username" placeholder="Enter your email or username" value="{{ old('email-username') }}" autofocus>
    @error('email-username')
    <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3 form-password-toggle">
    <div class="d-flex justify-content-between">
      <label class="form-label" for="password">Password</label>    
    </div>
    <div class="input-group input-group-merge">
      <input type="password" id="password" class="form-control" name="password" placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;" aria-describedby="password">
      <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
    </div>      
      <a href="{{ url('auth/forgot-password-cover') }}">
        <small>Forgot Password?</small>
      </a>

    @error('password')
    <div class="text-danger">{{ $message }}</div>
    @enderror
  </div>
  <div class="mb-3">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" id="remember-me">
      <label class="form-check-label" for="remember-me">
        Remember Me
      </label>
    </div>
  </div>
  <button class="btn btn-primary d-grid w-100">
    Masuk
  </button>
</form>


        <!-- <p class="text-center">
          <span>New on our platform?</span>
          <a href="{{url('auth/register-cover')}}">
            <span>Create an account</span>
          </a>
        </p>

        <div class="divider my-4">
          <div class="divider-text">or</div>
        </div>

        <div class="d-flex justify-content-center">
          <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
            <i class="tf-icons fa-brands fa-google fs-5"></i>
          </a>

          <a href="javascript:;" class="btn btn-icon btn-label-twitter">
            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
          </a> -->
        </div>
      </div>
    </div>
    <!-- /Login -->
  </div>
</div>
@endsection