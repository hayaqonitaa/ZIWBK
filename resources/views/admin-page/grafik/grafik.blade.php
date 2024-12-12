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
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Grafik Survey</h5>
        <div>
          <select class="form-select w-auto" id="filterTahun" aria-label="Filter Tahun">
            @foreach ($tahunKuisioner as $tahun)
              <option value="{{ $tahun }}" {{ $tahun == \Carbon\Carbon::now()->year ? 'selected' : '' }}>{{ $tahun }}</option>
            @endforeach
          </select>        
        </div>
      </div>
      <div class="card-body">
        <canvas id="barChart" class="chartjs" data-height="400"></canvas>
      </div>
    </div>
  </div>
</div>

<!-- Tabel Pertanyaan -->
<div class="row">
  <div class="col-xl-12 col-12">
    <div class="card">
      <div class="card-header">
        <h5 class="card-title mb-0">Daftar Pertanyaan</h5>
      </div>
      <div class="card-body">
        <div id="pertanyaanTable" class="table-responsive"></div>
      </div>
    </div>
  </div>
</div>

@endsection


