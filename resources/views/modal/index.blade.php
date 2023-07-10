<div class="modal fade" id="tambahRuanganModal" tabindex="-1" aria-labelledby="tambahRuanganModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.ruangan.store') }}" enctype="multipart/form-data" method="POST">
                @method("POST")
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahRuanganModalLabel">Tambah ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama Ruangan</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="nama_ruangan">
                            <label for="">Foto Ruangan</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="foto" onchange="changeLabel(this)" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <label for="">Gedung</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="gedung">
                            <label for="">Kepala Lab</label>
                            <select name="user_id" id="" class="custom-select shadow-sm mb-3">
                                <option disabled selected>Select Option</option>
                                @foreach (\App\Models\User::all() as $item)
                                    @if ($item->roles == 'kepala_lab')
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
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

<div class="modal fade" id="tambahPeminjamanModal" tabindex="-1" aria-labelledby="tambahPeminjamanModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.peminjaman.store') }}" method="post" id="editFormRuangan" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPeminjamanModalLabel">Tambah Peminjaman</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            {{-- <label for="">Kode Ruangan</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="kode_ruangan"> --}}
                            <label for="">Nama Ruangan</label>
                            <select name="nama_ruangan" id="" class="custom-select shadow-sm mb-3" onchange="getNamaRuangan(this)" data-check="peminjaman">
                                <option selected disabled>Select Option</option>
                                @foreach (\App\Models\Ruangan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            <label for="">Nama Alat</label>
                            <select name="nama_barang" id="barangAlat" class="custom-select shadow-sm mb-3" onchange="changeJumlah(this)" data-check="peminjaman">
                                <option selected disabled>Select Option</option>
                            </select>
                            <label for="">Waktu Peminjaman</label>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">Dari</label>
                                    <input type="date" class="form-control shadow-sm mb-3" name="waktu_peminjaman_ambil" onchange="waktuDari(this)">
                                </div>
                                <div class="col-md">
                                    <label for="">Sampai</label>
                                    <input type="date" class="form-control shadow-sm mb-3" name="waktu_peminjaman_kembali" id="waktuSampaiInput">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">Alat Tersedia</label>
                                    <input type="number" class="form-control shadow-sm mb-3" name="jumlah" disabled id="alatTersedia">
                                </div>
                                <div class="col-md">
                                    <label for="">Jumlah Peminjaman</label>
                                    <input type="number" class="form-control shadow-sm mb-3" name="jumlah" id="alatJumlah" onkeyup="checkJumlah(this)">
                                </div>
                            </div>
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

<div class="modal fade" id="tambahPemakaianModal" tabindex="-1" aria-labelledby="tambahPemakaianModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('admin.pemakaian.store') }}" method="post" id="editFormRuangan" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahPemakaianModalLabel">Tambah Pemakaian</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            {{-- <label for="">Kode Ruangan</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="kode_ruangan"> --}}
                            <label for="">Nama Ruangan</label>
                            <select name="nama_ruangan" id="" class="custom-select shadow-sm mb-3" onchange="getNamaRuangan(this)" data-check="pemakaian">
                                <option selected disabled>Select Option</option>
                                @foreach (\App\Models\Ruangan::all() as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            <label for="">Nama Bahan</label>
                            <select name="nama_barang" id="barangBahan" class="custom-select shadow-sm mb-3" onchange="changeJumlah(this)" data-check="pemakaian">
                                <option selected disabled>Select Option</option>
                            </select>
                            <label for="">Waktu Pemakaian</label>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">Dari</label>
                                    <input type="date" class="form-control shadow-sm mb-3" name="waktu_pemakaian_ambil" onchange="waktuDari(this)">
                                </div>
                                <div class="col-md">
                                    <label for="">Sampai</label>
                                    <input type="date" class="form-control shadow-sm mb-3" name="waktu_pemakaian_kembali" id="waktuSampaiInput">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md">
                                    <label for="">Bahan Tersedia</label>
                                    <input type="number" class="form-control shadow-sm mb-3" name="jumlah" disabled id="bahanTersedia">
                                </div>
                                <div class="col-md">
                                    <label for="">Jumlah Peminjaman</label>
                                    <input type="number" class="form-control shadow-sm mb-3" name="jumlah" id="bahanJumlah" onkeyup="checkJumlah(this)">
                                </div>
                            </div>
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

<div class="modal fade" id="editModalRuangan" tabindex="-1" aria-labelledby="editModalRuanganLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="editFormRuangan" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalRuanganLabel">Edit Ruangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama Ruangan</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="nama_ruangan" id="namaRuangan">
                            <label for="">Foto Ruangan</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="foto" onchange="changeLabel(this)" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <label for="">Gedung</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="gedung" id="gedungRuangan">
                            <label for="">Kepala Lab</label>
                            <select name="user_id" id="kepalaRuangan" id="" class="custom-select shadow-sm mb-3">
                                <option disabled selected>Select Option</option>
                                @foreach (\App\Models\User::all() as $item)
                                    @if ($item->roles == 'kepala_lab')
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModalBahan" tabindex="-1" aria-labelledby="editModalBahanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="editFormBahan" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalBahanLabel">Edit Bahan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="nama" id="namaBahan">
                            <label for="">Kode Bahan</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="kode_bahan" id="KodeBahan">
                            <label for="">Foto</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="foto" onchange="changeLabel(this)" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <label for="">Stok Jumlah</label>
                            <input type="number" class="form-control shadow-sm mb-3" name="stok_jumlah" id="stokJumlahBahan">
                            <label for="">Tanggal Masuk</label>
                            <input type="date" class="form-control shadow-sm mb-3" name="tanggal_masuk" id="tanggalMasukBahan">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editModalAlat" tabindex="-1" aria-labelledby="editModalAlatLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" id="editFormAlat" enctype="multipart/form-data">
                @method("PUT")
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalAlatLabel">Edit Alat</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <label for="">Nama</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="nama" id="namaAlat">
                            <label for="">Kode Alat</label>
                            <input type="text" class="form-control shadow-sm mb-3" name="kode_alat" id="KodeAlat">
                            <label for="">Foto</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="inputGroupFile01" name="foto" onchange="changeLabel(this)" aria-describedby="inputGroupFileAddon01" accept="image/*">
                                    <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                                </div>
                            </div>
                            <label for="">Stok Jumlah</label>
                            <input type="number" class="form-control shadow-sm mb-3" name="stok_jumlah" id="stokJumlahAlat">
                            <label for="">Tanggal Masuk</label>
                            <input type="date" class="form-control shadow-sm mb-3" name="tanggal_masuk" id="tanggalMasukAlat">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-warning">Edit</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form enctype="multipart/form-data" method="POST" id="formHapusModal">
                @method("DELETE")
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md">
                            <h4>Apakah yakin untuk menghapus ini?</h4>
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