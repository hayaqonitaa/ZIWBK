@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard Admin')

@section('content')

<!-- Layout Demo -->
<div class="layout-demo-wrapper">
<form id="logout-form" action="{{ route('auth-logout') }}" method="POST" style="display: none;">
  @csrf
</form>

<button class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
  Logout
</button>

  <div class="layout-demo-placeholder">
    <img src="{{asset('assets/img/layouts/layout-content-navbar-'.$configData['style'].'.png')}}" class="img-fluid" alt="Layout content navbar" data-app-light-img="layouts/layout-content-navbar-light.png" data-app-dark-img="layouts/layout-content-navbar-dark.png">
  </div>
  <div class="layout-demo-info">
    <h4>Layout content navbar</h4>
    <p>Template default layout, navbar in content area.</p>
  </div>
</div>
<!--/ Layout Demo -->
@endsection
