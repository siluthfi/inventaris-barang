<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <title>Inventaris Barang</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <link href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">Inventaris</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                {{-- <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li> --}}
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    @guest
                        <a href="{{ route('login') }}" class="nav-link">Login</a>
                    @endguest
                    @auth
                        <form action="{{ route('logout') }}" method="post" id="logoutForm">
                            @csrf
                            <a class="nav-link" onclick="logoutNav(this)" style="cursor: pointer">Logout</a>
                        </form>
                    @endauth
                </li>
            </ul>
        </div>
    </nav>

    <div class="container-fluid">
        @if(isset($id))
            @if (!str_contains(url()->current(), 'bahan') && !str_contains(url()->current(), 'alat'))
                <div class="row mt-5 justify-content-center">
                    <div class="col-md-4">
                        <div class="card border-0">
                            <img src="{{ asset('img/wrench-solid.svg') }}" class="card-img-top mx-auto" alt="..." style="width: 230px">
                            <div class="card-body text-center">
                                <h5 class="card-title">Alat</h5>
                                <a href="{{ route('dashboard.ruangan.alat', $id) }}" class="btn btn-primary d-block">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0">
                            <img src="{{ asset('img/box-solid.svg') }}" class="card-img-top mx-auto" alt="..." style="width: 200px">
                            <div class="card-body text-center">
                                <h5 class="card-title">Bahan</h5>
                                <a href="{{ route('dashboard.ruangan.bahan', $id) }}" class="btn btn-primary d-block">Lihat Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (str_contains(url()->current(), 'bahan'))
                <div class="row mt-5">
                    <div class="col-md">
                        <h1 class="text-center">Bahan</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10 mt-5">
                        <div class="card shadow">
                            <div class="card-header bg-success">
                            </div>
                            <div class="card-body">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            @elseif (str_contains(url()->current(), 'alat'))
                <div class="row mt-5">
                    <div class="col-md">
                        <h1 class="text-center">Alat</h1>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-10 mt-5">
                        <div class="card shadow">
                            <div class="card-header bg-success">
                            </div>
                            <div class="card-body">
                                {{ $dataTable->table() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @else
            <div class="row mt-5">
                <div class="col-md">
                    <h1 class="text-center">Inventaris Barang</h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-10 mt-5">
                    <div class="card shadow">
                        <div class="card-header bg-success">
                        </div>
                        <div class="card-body">
                            {{ $dataTable->table() }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

    <script>
        function logoutNav(target) {
            target.preventDefault
            document.querySelector('#logoutForm').submit()
        }
    </script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    @if(!isset($id))
        {{ $dataTable->scripts() }}
    @endif
    @if (str_contains(url()->current(), 'bahan'))    
        {{ $dataTable->scripts() }}
    @elseif (str_contains(url()->current(), 'alat'))
        {{ $dataTable->scripts() }}
    @endif
</body>
</html>