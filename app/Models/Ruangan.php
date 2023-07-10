<?php

namespace App\Models;

use App\Models\Alat;
use App\Models\User;
use App\Models\Bahan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ruangan extends Model
{
    use HasFactory;

    protected $table = "ruangans";

    protected $fillable = [
        'nama_ruangan',
        'foto',
        'gedung',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bahan()
    {
        return $this->hasMany(Bahan::class);
    }

    public function alat()
    {
        return $this->hasMany(Alat::class);
    }
}
