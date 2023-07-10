<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;

    protected $table = 'peminjaman';

    protected $fillable = [
        'kode_barang',
        'nama_ruangan',
        'nama_barang',
        'tanggal_dipakai',
        'waktu_peminjaman',
        'waktu_peminjaman_ambil',
        'waktu_peminjaman_kembali',
        'id_ruangan',
        'jumlah',
    ];
}
