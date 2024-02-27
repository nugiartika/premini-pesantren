<?php

namespace App\Http\Controllers;

use App\Models\mapel;
use App\Http\Requests\StoremapelRequest;
use App\Http\Requests\UpdatemapelRequest;
use Illuminate\Http\Request;


class MapelController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $cmapel = $request->input('search');
            $mapel = Mapel::where('nama', 'LIKE', "%$cmapel%")->paginate(5);
        } else {
            $mapel = Mapel::paginate(5);
        }
        return view('mapel.mapel', compact('mapel'));

    }

    public function create()
    {
        $mapel = Mapel::all();
        return view('mapel.mapel', compact('mapel'));
    }

    public function store(StoremapelRequest $request)
    {

        Mapel::create([
            'nama' => $request->input('nama'),
        ]);

        return redirect()->route('mapel.index')->with('success', 'MAPEL BERHASIL DITAMBAHKAN');

    }

    public function show(mapel $mapel)
    {
        //
    }

    public function edit(mapel $mapel)
    {
        $mapel = Mapel::all();
        return view('mapel.mapel', compact('mapel'));
    }

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

    public function destroy(mapel $mapel)
    {
        if ($mapel->kelulusan()->exists()) {
            return redirect()->route('mapel.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $mapel->delete();
        return redirect()->route('mapel.index')->with('success', 'MAPEL BERHASIL DIHAPUS');
    }
}
