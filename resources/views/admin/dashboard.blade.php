{{-- resources/views/dashboard.blade.php --}}
@extends('layouts.app')

@section('title', 'Dashboard')
@section('sub-title', 'Selamat datang di panel admin')

@section('content')
<div class="col-12">
  <div class="card mb-4">
    <div class="card-header">Statistik</div>
    <div class="card-body">
      <p>Selamat datang, {{ auth()->user()->name }}!</p>
    </div>
  </div>
</div>
@endsection
