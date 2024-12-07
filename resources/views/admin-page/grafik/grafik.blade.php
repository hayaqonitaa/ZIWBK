@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Dashboard Admin')

@section('vendor-script')
@vite(['resources/assets/vendor/libs/chartjs/chartjs.js'])
@endsection

@section('page-script')
@vite(['resources/assets/js/admin/grafik/grafik.js'])
@endsection

@section('content')

<!-- Layout Demo -->
<div class="row">
  <!-- Bar Charts -->
  <div class="col-xl-12 col-12 mb-4">
    <div class="card">
      <div class="card-header header-elements">
        <h5 class="card-title mb-0">Latest Statistics</h5>
        <div class="card-action-element ms-auto py-0">
          <div class="dropdown">
            <button type="button" class="btn dropdown-toggle px-0" data-bs-toggle="dropdown" aria-expanded="false"><i class="ti ti-calendar"></i></button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Today</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Yesterday</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 7 Days</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last 30 Days</a></li>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Current Month</a></li>
              <li><a href="javascript:void(0);" class="dropdown-item d-flex align-items-center">Last Month</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="card-body">
        <canvas id="barChart" class="chartjs" data-height="400"></canvas>
      </div>
    </div>
  </div>
  <!-- /Bar Charts -->
</div>
<!--/ Layout Demo -->
@endsection
