@extends('layouts/layoutMaster')

@section('title', 'Hasil Survey')

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
  <form action="{{ route('hasil_survey.import') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="file">Import Hasil Survey</label>
      <input type="file" name="file" class="form-control" accept=".xlsx,.csv" required>
    </div>
    <button type="submit" class="btn btn-primary mt-2">Import</button>
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
      <tbody>
        @foreach($hasil_survey as $survey)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $survey->mahasiswa->nim }}</td>
          <td>{{ $survey->kuesioner->nama }}</td> <!-- Asumsi 'nama' adalah kolom dari model Kuesioner -->
          <td>{{ $survey->pertanyaan }}</td>
          <td>{{ $survey->jawaban }}</td>
          <td>{{ $survey->semester }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

@section('page-script')
@vite(['resources/assets/js/admin/hasil_survey/hasil_survey.js'])
@endsection