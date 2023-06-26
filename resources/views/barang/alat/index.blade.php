@extends('adminlte::page')

@section('title', $title )

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    @if (session('success'))
        <div class="row">
            <div class="col-md">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-md mb-4">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                <i class="fas fa-plus"></i>
            </button>
            
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="{{ route('admin.alat.store') }}" enctype="multipart/form-data" method="POST">
                            @method("POST")
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah alat</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control shadow-sm mb-3" name="nama">
                                        <label for="">Kode Alat</label>
                                        <input type="text" class="form-control shadow-sm mb-3" name="kode_alat">
                                        <label for="">Foto</label>
                                        <input type="text" class="form-control shadow-sm mb-3" name="foto">
                                        <label for="">Stok Jumlah</label>
                                        <input type="number" class="form-control shadow-sm mb-3" name="stok_jumlah">
                                        <label for="">Tanggal Masuk</label>
                                        <input type="date" class="form-control shadow-sm mb-3" name="tanggal_masuk">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
  
        </div>
    </div>
    <x-adminlte-card theme="lime" theme-mode="outline">
        <div class="row">
            <div class="col-md">
                {{ $dataTable->table() }}
            </div>
        </div>
    </x-adminlte-card>
@stop

@section('css')
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    {{ $dataTable->scripts() }}
    {{-- <script> console.log('Hi!'); </script> --}}
@stop