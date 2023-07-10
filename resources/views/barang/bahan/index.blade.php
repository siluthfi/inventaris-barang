@extends('adminlte::page')

@section('title', $title )

@section('content_header')
    <h1>{{ $title }}</h1>
@stop

@section('content')

    @if (session("success"))
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
                        <form action="{{ route('admin.bahan.store') }}" enctype="multipart/form-data" method="POST">
                            @method("POST")
                            @csrf
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Tambah Bahan</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md">
                                        <label for="">Nama</label>
                                        <input type="text" class="form-control shadow-sm mb-3" name="nama">
                                        <label for="">Kode Bahan</label>
                                        <input type="text" class="form-control shadow-sm mb-3" name="kode_bahan">
                                        <label for="">Foto</label>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                            </div>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="inputGroupFile01" name="foto" aria-describedby="inputGroupFileAddon01" accept="image/*" onchange="changeLabel(this)">
                                                <label class="custom-file-label" for="inputGroupFile01" id="fileBahanLabel">Choose file</label>
                                            </div>
                                        </div>
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
    @include('modal.index')
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
    <script src="{{ asset('js/script.js') }}"></script>
    {{ $dataTable->scripts() }}
    <script>
        function handleDelete(value) {
            $('#deleteModal').modal('toggle')
            const formhapus = document.querySelector('#formHapusModal');
            formhapus.setAttribute('action', value.dataset.url);
        }

        function handleEdit(value) {
            $.ajax({
                url: `{{ route('admin.ajax.getBahan') }}/${value.dataset.id}`,
                dataType: "JSON",
                type: "GET",
                success: function(data) {
                    $('#editModalBahan').modal('toggle')
                    const editFormBahan = document.querySelector("#editFormBahan");
                    editFormBahan.setAttribute('action', value.dataset.url)

                    const namaBahan = document.querySelector("#namaBahan");
                    const KodeBahan = document.querySelector("#KodeBahan");
                    const stokJumlahBahan = document.querySelector("#stokJumlahBahan");
                    const tanggalMasukBahan = document.querySelector("#tanggalMasukBahan");

                    namaBahan.value = data.nama
                    KodeBahan.value = data.kode_bahan
                    stokJumlahBahan.value = data.stok_jumlah
                    tanggalMasukBahan.value = data.tanggal_masuk.split(' ')[0]
                }
            })
        }
    </script>
    {{-- <script> console.log('Hi!'); </script> --}}
@stop