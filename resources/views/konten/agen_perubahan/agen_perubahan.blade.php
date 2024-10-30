@extends('layouts/layoutMaster')

@section('title', 'Content navbar - Layouts')

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
@vite(['resources/assets/js/konten/agen_perubahan/agenPerubahan.js'])
@vite(['resources/assets/js/konten/agen_perubahan/addAgenPerubahan.js'])
@vite(['resources/assets/js/admin/jurusan/editJurusan.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Agen Perubahan
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
    <h5 class="mb-0">Agen Perubahan</h5>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentAgenPerubahan">
      <i class="fa-solid fa-plus"></i>
    </button>
  </div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
            <th>No.</th>
            <th>Nama</th>
            <th>Jabatan</th>
            <th>Foto</th>
            <th>Created By</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->

@include('konten/agen_perubahan/modal-add')
@include('admin-page/jurusan/modal-edit-jurusan')

@endsection
