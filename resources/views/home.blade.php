@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md">
            <x-adminlte-info-box title="Bahan" text="{{ $bahan }}" icon="fas fa-lg fa-box text-dark" theme="gradient-teal"/>
        </div>
        <div class="col-md">
            <x-adminlte-info-box title="Alat" text="{{ $alat }}" icon="fas fa-lg fa-wrench text-dark" theme="gradient-orange"/>
        </div>
        <div class="col-md">
            <x-adminlte-info-box title="Ruangan" text="{{ $ruangan }}" icon="fas fa-lg fa-building text-dark" theme="gradient-red"/>
        </div>
    </div>
    <div class="row">
        <div class="col-md">
            <x-adminlte-info-box title="Pemakaian" text="{{ $pemakaian }}" icon="fas fa-lg fa-hand-holding text-dark" theme="gradient-green"/>
        </div>
        <div class="col-md">
            <x-adminlte-info-box title="Peminjaman" text="{{ $peminjaman }}" icon="fas fa-lg fa-handshake text-dark" theme="gradient-yellow"/>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop