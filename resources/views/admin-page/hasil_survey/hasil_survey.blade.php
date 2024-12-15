@extends('layouts/layoutMaster')

@section('title', 'Hasil Survey')

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
@vite(['resources/assets/js/admin/hasil_survey/hasil_survey.js'])
@vite(['resources/assets/js/admin/hasil_survey/delete_hasil_survey.js'])
<!-- @vite(['resources/assets/js/admin/kuesioner/addKuesioner.js'])
@vite(['resources/assets/js/admin/kuesioner/editKuesioner.js']) -->
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Hasil Survey
</h4>

@if(session('success'))
  <div class="alert alert-dismissible d-flex align-items-center bg-label-info mb-0 show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999;">
    <i class="fas fa-check-circle me-2"></i>
    <div>{{ session('success') }}</div>
    <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<!-- Import form -->
<div class="mb-4">
<form id="importForm" enctype="multipart/form-data">
  <div class="form-group">
    <label for="file">Pilih File</label>
    <input type="file" name="file" id="file" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Import</button>
</form>


</div>

<!-- Data Table -->
<div class="card">
  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
          <th>No</th>
          <th>NIM</th>
          <th>Kuesioner</th>
          <th>Pertanyaan</th>
          <th>Jawaban</th>
          <th>Semester</th>
        </tr>
      </thead>
    </table>
  </div>
</div>

@endsection

@section('page-script')
@vite(['resources/assets/js/admin/hasil_survey/hasil_survey.js'])
@endsection