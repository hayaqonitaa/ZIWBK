@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Prodi')

@section('content')

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/admin/prodi/prodi.js'])
@vite(['resources/assets/js/admin/prodi/addProdi.js'])
@vite(['resources/assets/js/admin/prodi/editProdi.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Prodi
</h4>

<!-- Scrollable -->
<div class="card">
<div class="d-flex justify-content-between align-items-center card-header">
    <h5 class="mb-0">Prodi</h5>
    <!-- button add -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addProdi">
      <i class="fa-solid fa-plus"></i>
    </button>
  </div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Jurusan</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->

@include('admin-page/prodi/modal-prodi')
@include('admin-page/prodi/modal-edit-prodi')

@endsection
