<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
    use HasFactory;

    protected $table = "alats";

    protected $fillable = [
        "nama",
        "kode_alat",
        "foto",
        "stok_jumlah",
        "tanggal_masuk",
        "id_kategori",  
    ];
}
