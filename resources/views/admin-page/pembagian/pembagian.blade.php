@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Pembagian Kuesioner - Mahasiswa')

@section('content')

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/admin/pembagian/tablePembagian.js'])
@vite(['resources/assets/js/admin/pembagian/deletePembagian.js'])
@endsection

<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Pembagian Kuesioner
</h4>

<!-- Display success notification if exists -->
@if(session('success'))
  <div class="alert alert-dismissible d-flex align-items-center bg-label-info mb-0 show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <i class="fas fa-check-circle me-2"></i>
    <div>
      {{ session('success') }}
    </div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<!-- Scrollable -->
<div class="card">
<div class="d-flex justify-content-between align-items-center card-header">
  <h5 class="mb-0">Data Pengisian Kuesioner</h5>
  <!-- button add -->
  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#sendEmailModal">
    Kirim<i class="fa-solid fa-paper-plane ms-2"></i>
  </button>
  <input type="hidden" id="kuesionerId" value="">
</div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Judul</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <!-- Data akan dimuat melalui JavaScript/DataTables -->
      </tbody>
    </table>
  </div>
</div>
<!--/ Scrollable -->
@include('admin-page/pembagian/modal-add-kirim')

@endsection
