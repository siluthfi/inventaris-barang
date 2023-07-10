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
            {!! $buttons !!}

            <!-- Modal -->
            @include('modal.index')
        </div>
    </div>

    {{-- @if (route('admin.peminjaman.index'))
        <div class="row mb-4">
            <div class="col-md">
                <a href="" class="btn btn-success">Barang Kembali</a>
                <a href="" class="btn btn-primary">Barang Masuk</a>
                <a href="" class="btn btn-primary">Barang Kembali</a>
            </div>
        </div>  
    @endif --}}

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

        function handleEditRuangan(value) {
            $.ajax({
                url: `{{ route('admin.ajax.getRuangan') }}/${value.dataset.id}`,
                dataType: "JSON",
                type: "GET",
                success: function(data) {
                    console.log(data)
                    $('#editModalRuangan').modal('toggle')
                    const editFormRuangan = document.querySelector("#editFormRuangan");
                    editFormRuangan.setAttribute('action', value.dataset.url)

                    const namaRuangan = document.querySelector("#namaRuangan")
                    const gedungRuangan = document.querySelector("#gedungRuangan")
                    const kepalaRuangan = document.querySelector("#kepalaRuangan")

                    namaRuangan.value = data.nama_ruangan
                    gedungRuangan.value = data.gedung
                    
                    if(data.user_id) {
                        kepalaRuangan.value = data.user_id
                    } else {
                        kepalaRuangan.value = "Select Option"
                    }
                }
            })
        }

        function getNamaRuangan(value) {
            let check = value.dataset.check
            let url = null;
            if(check == "pemakaian") {
                url = `{{ route('admin.ajax.getBahanRuangan') }}/${value.value}`
            } else if(check == "peminjaman"){
                url = `{{ route('admin.ajax.getAlatRuangan') }}/${value.value}`
            }
            $.ajax({
                url,
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    const barangAlat = document.querySelector("#barangAlat")
                    const barangBahan = document.querySelector("#barangBahan")
                    
                    let option = "<option selected disabled>Select Option</option>"
                    data.map(dat => {
                        option += `<option value="${dat.id}" data-stok="${dat.stok_jumlah}">${dat.nama}</option>`
                    })
                    if(check == "pemakaian") {
                        barangBahan.innerHTML = option
                    } else if(check == "peminjaman"){
                        barangAlat.innerHTML = option
                    }
                }
            })
        }

        function changeJumlah(value) {
            const alatTersedia = document.querySelector("#alatTersedia")
            const bahanTersedia = document.querySelector("#bahanTersedia")

            let check = value.dataset.check
            if(check == "pemakaian") {
                bahanTersedia.value = $(value).children('option:selected')[0].dataset.stok
            } else if(check == "peminjaman"){
                alatTersedia.value = $(value).children('option:selected')[0].dataset.stok
            }
        }

        function checkJumlah(value) {
            const alatTersedia = document.querySelector("#alatTersedia")
            const bahanTersedia = document.querySelector("#bahanTersedia")

            if(value.value > alatTersedia.value || value.value > bahanTersedia.value) {
                value.value = alatTersedia.value || bahanTersedia.value
            }
        }

        function waktuDari(value) {
            console.log(value.parentElement.nextElementSibling.lastElementChild)
            const waktuSampaiInput = value.parentElement.nextElementSibling.lastElementChild
            waktuSampaiInput.setAttribute('min', value.value)
        }
    </script>
@stop