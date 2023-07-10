<?php

namespace App\Models;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
