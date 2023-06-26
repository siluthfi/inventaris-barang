@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md">
            <x-adminlte-info-box title="Bahan" text="48" icon="fas fa-lg fa-box text-dark" theme="gradient-teal"/>
        </div>
        <div class="col-md">
            <x-adminlte-info-box title="Alat" text="20" icon="fas fa-lg fa-box text-dark" theme="gradient-orange"/>
        </div>
        <div class="col-md">
            <div class="card card-orange">
                <div class="card-body">
                    <img src="https://i.pinimg.com/564x/cb/16/bb/cb16bb284a2a80c75041c80ba63e62d3.jpg" class="img-fluid">
                    <h3 class="text-center mt-3">Wishlist</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <img src="https://i.pinimg.com/564x/cb/16/bb/cb16bb284a2a80c75041c80ba63e62d3.jpg" class="img-fluid">
                    <h3 class="text-center mt-3">Penggunaan Alat</h3>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <img src="https://i.pinimg.com/564x/cb/16/bb/cb16bb284a2a80c75041c80ba63e62d3.jpg" class="img-fluid">
                    <h3 class="text-center mt-3">Pemakaian Bahan</h3>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    {{-- <script> console.log('Hi!'); </script> --}}
@stop