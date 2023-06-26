<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    use HasFactory;

    protected $table = "bahans";

    protected $fillable = [
        "nama",
        "kode_bahan",
        "foto",
        "stok_jumlah",
        "tanggal_masuk",
        "id_kategori",
    ];
}
