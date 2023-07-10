<?php

namespace App\Http\Controllers;

use App\DataTables\RuanganDataTable;
use App\Models\Ruangan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Image;

class RuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RuanganDataTable $table)
    {
        return $table->render('datatable', [
            'title' => 'List Ruangan',
            "buttons" => '<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#tambahRuanganModal"><i class="fas fa-plus"></i></button>'
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
        $ruangan = new Ruangan();

        $ruangan->nama_ruangan = $request->nama_ruangan;

        $namesignature = null;
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/ruangan/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $namesignature = $path;
        }

        $ruangan->foto = $namesignature;
        $ruangan->gedung = $request->gedung;
        $ruangan->user_id = $request->user_id;
        $ruangan->save();

        return redirect()->back()->with('success', 'Ruangan berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function show(Ruangan $ruangan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function edit(Ruangan $ruangan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Ruangan $ruangan)
    {
        $ruangan->nama_ruangan = $request->nama_ruangan;

        $namesignature = $ruangan->foto;
        if ($request->hasFile('foto')) {
            if (File::exists(public_path($ruangan->foto))) {
                File::delete(public_path($ruangan->foto));
            }
            $file = $request->file('foto');
            $photo = Image::make($file->getPathName());
            $path = 'img/ruangan/' . time() . "_" . $file->getClientOriginalName();
            $photoUrl = $photo->save(public_path($path), 50);
            $namesignature = $path;
        }

        $ruangan->foto = $namesignature;
        $ruangan->gedung = $request->gedung;
        $ruangan->user_id = $request->user_id;
        $ruangan->save();

        return redirect()->back()->with('success', 'Ruangan berhasil di update!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ruangan  $ruangan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ruangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->back()->with('success', 'Ruangan berhasil dihapus!');
    }

    public function getRuangan($id)
    {
        $data = Ruangan::where('id', $id)->first();

        return response()->json($data);
    }
}
