<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use App\Http\Requests\StoremapelRequest;
use App\Http\Requests\UpdatemapelRequest;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::all();
        return view('mapel.mapel', compact('mapel'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mapel = Mapel::all();
        return view('mapel.mapel', compact('mapel'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremapelRequest $request)
    {
        $request->validate([
            'nama' => 'required|unique:mapels,nama',
        ], [
            'nama.required' => 'Kolom NAMA MAPEL wajib diisi.',
            'nama.unique' => 'NAMA MAPEL sudah digunakan.',
        ]);

        Mapel::create([
            'nama' => $request->input('nama'),
        ]);

        return redirect()->route('mapel.index')->with('success', 'MAPEL BERHASIL DITAMBAHKAN');

    }

    /**
     * Display the specified resource.
     */
    public function show(mapel $mapel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(mapel $mapel)
    {
        $mapel = Mapel::all();
        return view('mapel.mapel', compact('mapel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemapelRequest $request, mapel $mapel)
    {
        $request->validate([
            'nama' => 'required|unique:mapels,nama,' . $mapel->id,
        ], [
            'nama.required' => 'Kolom NAMA MAPEL wajib diisi.',
            'nama.unique' => 'NAMA MAPEL sudah digunakan.',
        ]);


        $mapel->update([
            'nama' => $request->input('nama'),
        ]);
        return redirect()->route('mapel.index')->with('success', 'MAPEL BERHASIL DIUPDATE');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(mapel $mapel)
    {
        if ($mapel->kelulusan()->exists() || $mapel->asatid()->exists()) {
            return redirect()->route('mapel.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $mapel->delete();
        return redirect()->route('mapel.index')->with('success', 'MAPEL BERHASIL DIHAPUS');
    }
}
