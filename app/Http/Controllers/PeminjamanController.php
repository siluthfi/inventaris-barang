<?php

namespace App\Http\Controllers;

use App\DataTables\PeminjamanDataTable;
use App\Models\Alat;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Http\Request;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PeminjamanDataTable $table)
    {
        return $table->render('datatable', [
            'title' => 'List Peminjaman',
            'buttons' => '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPeminjamanModal"><i class="fas fa-plus"></i></button>'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $peminjaman = new Peminjaman();

        // dd($request->all());
        $ruangan = Ruangan::where('id', $request->nama_ruangan)->first();
        $barang = Alat::where('id', $request->nama_barang)->first();
        // dd($barang);

        $peminjaman->nama_ruangan = $ruangan->nama_ruangan;
        $peminjaman->nama_barang = $barang->nama;
        $peminjaman->waktu_peminjaman_ambil = $request->waktu_peminjaman_ambil;
        $peminjaman->waktu_peminjaman_kembali = $request->waktu_peminjaman_kembali;
        $peminjaman->id_ruangan = $ruangan->id;
        $peminjaman->jumlah = $request->jumlah;

        $barang->stok_jumlah = $barang->stok_jumlah - $request->jumlah;

        $barang->save();
        $peminjaman->save();
        
        return redirect()->back()->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function show(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function edit(Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Peminjaman $peminjaman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Peminjaman  $peminjaman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Peminjaman $peminjaman)
    {
        //
    }
}
