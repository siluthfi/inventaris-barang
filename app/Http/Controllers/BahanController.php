<?php

namespace App\Http\Controllers;

use App\DataTables\Barang\BahanDataTable;
use App\Models\Bahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BahanDataTable $dataTable)
    {
        return $dataTable->render('barang.bahan.index', [
            'title' => "List Bahan"
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
        $bahan = new Bahan();

        $bahan->nama = $request->nama;
        $bahan->kode_bahan = $request->kode_bahan;

        $namesignature = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/bahan/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $namesignature = $path;
        }

        $bahan->foto = $namesignature;

        $bahan->stok_jumlah = $request->stok_jumlah;
        $bahan->tanggal_masuk = $request->tanggal_masuk;
        $bahan->save();

        return redirect()->back()->with('success', 'Bahan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function show(Bahan $bahan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function edit(Bahan $bahan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bahan $bahan)
    {
        $bahan->nama = $request->nama;
        $bahan->kode_bahan = $request->kode_bahan;

        $namesignature = $bahan->foto;
        if ($request->hasFile('foto')) {
            if (File::exists(public_path($bahan->foto))) {
                File::delete(public_path($bahan->foto));
            }
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/bahan/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $namesignature = $path;
        }

        $bahan->foto = $namesignature;

        $bahan->stok_jumlah = $request->stok_jumlah;
        $bahan->tanggal_masuk = $request->tanggal_masuk;
        $bahan->save();

        return redirect()->back()->with('success', 'Bahan berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bahan  $bahan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bahan $bahan)
    {
        $bahan->delete();
        return redirect()->back()->with('success', 'Bahan berhasil dihapus!');
    }

    public function getBahan($id)
    {
        $data = Bahan::where('id', $id)->first();

        return response()->json($data);
    }

    public function getBahanRuangan($id)
    {
        $data = Bahan::where('id_ruangan', $id)->get();

        return response()->json($data);
    }
}
