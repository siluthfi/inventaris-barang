<?php

namespace App\Models;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        "id_ruangan",  
    ];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class);
    }
}
