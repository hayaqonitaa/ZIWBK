@extends('layouts/layoutMaster')

@section('title', $berita->judul)

@section('content')
<div class="container mt-5">
    <br><br><br>
    <h1>{{ $berita->judul }}</h1>
    <h6>Created on {{ $berita->created_at->format('d M Y') }} by {{ $berita->users->name }}</h6> 
    <img src="{{ asset('storage/' . $berita->file) }}" alt="{{ $berita->judul }}" class="img-fluid mb-4" />
    <p>{!! $berita->deskripsi !!}</p>
</div>
@endsection
