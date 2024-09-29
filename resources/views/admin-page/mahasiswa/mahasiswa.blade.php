@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Content navbar - Layouts')

@section('content')

<!-- Vendor Scripts -->
@section('vendor-script')
@vite(['resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js'])
@endsection

<!-- Page Scripts -->
@section('page-script')
@vite(['resources/assets/js/admin/mahasiswa/mahasiswa.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Mahasiswa
</h4>

<!-- Scrollable -->
<div class="card">
  <h5 class="card-header">Mahasiswa</h5>
  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
          <th>NIM</th>
          <th>Nama</th>
          <th>Prodi</th>
          <th>Email</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->

@endsection
