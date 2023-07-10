<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Ruangan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;
use App\DataTables\PemakaianDataTable;
use App\Models\Bahan;

class PemakaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PemakaianDataTable $table)
    {
        return $table->render('datatable', [
            'title' => 'List Pemakaian',
            'buttons' => '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahPemakaianModal"><i class="fas fa-plus"></i></button>'
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
        $pemakaian = new Pemakaian();

        // dd($request->all());
        $ruangan = Ruangan::where('id', $request->nama_ruangan)->first();
        $barang = Bahan::where('id', $request->nama_barang)->first();

        $pemakaian->nama_ruangan = $ruangan->nama_ruangan;
        $pemakaian->nama_barang = $barang->nama;
        $pemakaian->waktu_pemakaian_ambil = $request->waktu_pemakaian_ambil;
        $pemakaian->waktu_pemakaian_kembali = $request->waktu_pemakaian_kembali;
        $pemakaian->id_ruangan = $ruangan->id;
        $pemakaian->jumlah = $request->jumlah;

        $jumlah = $barang->stok_jumlah - $request->jumlah;
        $barang->stok_jumlah = $jumlah;

        $barang->save();
        $pemakaian->save();
        
        return redirect()->back()->with('success', 'Pemakaian berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function show(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function edit(Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pemakaian $pemakaian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pemakaian  $pemakaian
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pemakaian $pemakaian)
    {
        //
    }
}
