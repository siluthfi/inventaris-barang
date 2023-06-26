<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = "wishlists";

    protected $fillable = [
        'kode_barang',
        'nama_ruangan',
        'nama_pemakai',
        'nama_barang',
        'jumlah',  
    ];
}
