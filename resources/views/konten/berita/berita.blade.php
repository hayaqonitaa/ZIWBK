@extends('layouts/layoutMaster')

@section('title', 'Berita')

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
@vite(['resources/assets/js/konten/berita/berita.js'])
@vite(['resources/assets/js/konten/berita/addBerita.js'])
@vite(['resources/assets/js/konten/berita/editBerita.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Berita
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
    <h5 class="mb-0">Berita</h5>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addContentBerita">
      <i class="fa-solid fa-plus"></i>
    </button>
  </div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
            <th>No.</th>
            <th>Judul</th>
            <!-- <th>Deskripsi</th> -->
            <th>Gambar</th>
            <!-- <th>Link</th> -->
            <th>Status</th>
            <th>Created By</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->

@include('konten/berita/modal-add')
@include('konten/berita/modal-edit')

@endsection