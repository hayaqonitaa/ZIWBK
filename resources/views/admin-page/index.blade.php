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
  <div class="col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="badge p-2 bg-label-info mb-2 rounded"><i class="ti ti-checkbox ti-lg"></i></div>
        <h5 class="card-title mb-1 pt-2">Total Kuesioner Terkirim</h5>
        <!-- <small class="text-muted">Last week</small> -->
        <p class="mb-2 mt-1">{{ $totalTerkirim }}</p>
        <!-- <div class="pt-1">
          <span class="badge bg-label-secondary">-12.2%</span>
        </div> -->
      </div>
    </div>
  </div>
  <div class="col-md-6 col-12 mb-4">
    <div class="card">
      <div class="card-body">
        <div class="badge p-2 bg-label-info mb-2 rounded"><i class="ti ti-book ti-lg"></i></div>
        <h5 class="card-title mb-1 pt-2">Total Mahasiswa</h5>
        <!-- <small class="text-muted">Last week</small> -->
        <p class="mb-2 mt-1">{{$totalMahasiswa}}</p>
        <!-- <div class="pt-1">
          <span class="badge bg-label-secondary">-12.2%</span>
        </div> -->
      </div>
    </div>
  </div>
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
</div>
<!--/ Layout Demo -->
@endsection
