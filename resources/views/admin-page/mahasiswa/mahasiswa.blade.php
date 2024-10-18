@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Content navbar - Layouts')

@section('content')

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@vite(['resources/assets/vendor/libs/dropzone/dropzone.scss'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/admin/mahasiswa/mahasiswa.js'])
@vite(['resources/assets/js/admin/mahasiswa/addMahasiswa.js'])
@vite(['resources/assets/js/admin/mahasiswa/addFileMahasiswa.js'])
@vite(['resources/assets/js/admin/mahasiswa/editMahasiswa.js'])
@vite(['resources/assets/js/admin/mahasiswa/deleteMahasiswa.js'])
@vite(['resources/assets/js/admin/pembagian/pembagian.js'])
@vite(['resources/assets/vendor/libs/dropzone/dropzone.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Mahasiswa
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
    <h5 class="mb-0">Data Mahasiswa</h5>
        <div class="d-flex"> <!-- Flex container for buttons -->
            <!-- Button to share questionnaire -->
            <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#shareQuestionnaireModal">
                <i class="fas fa-paper-plane"></i> Bagikan Kuesioner
            </button>
            <!-- Button to add new Mahasiswa -->
            <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#addMahasiswa">
                <i class="fa-solid fa-plus"></i>
            </button>


            <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal" data-bs-target="#uploadExcelModal">
              <i class="fas fa-upload"></i> Upload Excel
            </button>

        </div>
    </div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
          <th><input type="checkbox" id="selectAll"></th> <!-- Checkbox untuk Select All -->
          <th>No</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Prodi</th>
          <th>Email</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>
<!--/ Scrollable -->
<!--/ Scrollable -->
@include('admin-page/mahasiswa/modal-mahasiswa')
@include('admin-page/mahasiswa/modal-edit-mahasiswa')
@include('admin-page/mahasiswa/modal-upload-file-mahasiswa')
@include('admin-page/pembagian/modal-add-pembagian')


@endsection
