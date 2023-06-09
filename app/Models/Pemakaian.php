<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    use HasFactory;

    protected $table = "pemakaians";

    protected $fillable = [
        'kode_barang',
        'nama_ruangan',
        'nama_barang',
        'tanggal_dipakai',
        'waktu_pemakaian',
        'waktu_pemakaian_ambil',
        'waktu_pemakaian_kembali',
        'id_ruangan',
        'jumlah',
    ];
}
