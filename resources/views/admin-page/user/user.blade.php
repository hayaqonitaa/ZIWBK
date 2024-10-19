@extends('layouts.layoutMaster')

@section('title', 'User Management - Layouts')

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
@vite(['resources/assets/js/admin/user/user.js'])
@vite(['resources/assets/js/admin/user/addUser.js'])
@vite(['resources/assets/js/admin/user/editUser.js'])
@endsection

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Dashboard /</span> Users
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
    <h5 class="mb-0">User Management</h5>
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addUser">
      <i class="fa-solid fa-plus"></i> Add User
    </button>
  </div>

  <div class="card-datatable text-nowrap">
    <table class="dt-scrollableTable table">
      <thead>
        <tr>
            <th>No.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
<!--/ Scrollable -->

<!-- Add User Modal -->
@include('admin-page.user.modal-user')

<!-- Edit User Modal -->
@include('admin-page.user.modal-edit-user')

@endsection
