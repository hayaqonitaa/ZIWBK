@extends('layouts/layoutMaster')

@section('title', 'Tim Kerja')

@section('content')

@php
$configData = Helper::appClasses();
@endphp

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/konten/tim_kerja/timKerja.js'])
@vite(['resources/assets/js/konten/tim_kerja/addTimKerja.js'])
@vite(['resources/assets/js/konten/tim_kerja/editTimKerja.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Surat Keputusan
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
    <h5 class="mb-0">Surat Keputusan</h5>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentTimKerja">
      <i class="fa-solid fa-plus"></i>
    </button>
  </div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
            <th>No.</th>
            <th>Judul</th>
            <th>File</th>
            <th>Status</th>
            <th>Created By</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->

@include('konten/tim_kerja/modal-add')
@include('konten/tim_kerja/modal-edit')
@endsection
