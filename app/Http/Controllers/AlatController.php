<?php

namespace App\Http\Controllers;

use App\DataTables\Barang\AlatDataTable;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class AlatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AlatDataTable $table)
    {
        return $table->render('barang.alat.index', [
            'title' => 'List Alat'
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
        $alat = new Alat();

        $alat->nama = $request->nama;
        $alat->kode_alat = $request->kode_alat;

        $namesignature = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/alat/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $namesignature = $path;
        }

        $alat->foto = $namesignature;
        $alat->stok_jumlah = $request->stok_jumlah;
        $alat->tanggal_masuk = $request->tanggal_masuk;
        $alat->save();

        return redirect()->back()->with('success', 'Alat berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function show(Alat $alat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function edit(Alat $alat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Alat $alat)
    {
        $alat->nama = $request->nama;
        $alat->kode_alat = $request->kode_alat;

        $namesignature = $alat->foto;
        if ($request->hasFile('foto')) {
            if (File::exists(public_path($alat->foto))) {
                File::delete(public_path($alat->foto));
            }
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/alat/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $namesignature = $path;
        }

        $alat->foto = $namesignature;

        $alat->stok_jumlah = $request->stok_jumlah;
        $alat->tanggal_masuk = $request->tanggal_masuk;
        $alat->save();

        return redirect()->back()->with('success', 'Alat berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Alat  $alat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Alat $alat)
    {
        $alat->delete();
        return redirect()->back()->with('success', 'Alat berhasil dihapus!');
    }

    public function getAlat($id)
    {
        $data = Alat::where('id', $id)->first();

        return response()->json($data);
    }

    public function getAlatRuangan($id)
    {
        $data = Alat::where('id_ruangan', $id)->get();

        return response()->json($data);
    }
}
