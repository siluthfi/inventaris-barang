<?php

namespace App\Http\Controllers;

use App\DataTables\Barang\AlatDataTable;
use App\DataTables\Barang\BahanDataTable;
use App\Models\Alat;
use App\Models\Bahan;
use App\Models\Pemakaian;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'alat' => count(Alat::all()),
            'bahan' => count(Bahan::all()),
            'ruangan' => count(Ruangan::all()),
            'pemakaian' => count(Pemakaian::all()),
            'peminjaman' => count(Peminjaman::all()),
        ]);
    }

    public function showruangan($id)
    {
        return view('dashboard', [
            'id' => $id
        ]);
    }

    public function showalat(AlatDataTable $table, $id)
    {
        return $table->render('dashboard', [
            'id' => $id
        ]);
    }

    public function showbahan(BahanDataTable $table, $id)
    {
        return $table->render('dashboard', [
            'id' => $id
        ]);
    }

    public function profile()
    {
        return view('profile', [
            'title' => 'Profile'
        ]);
    }
}
