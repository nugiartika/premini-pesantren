<?php

namespace App\Http\Controllers;

use App\Models\Asatid;
use App\Models\Asatidlist;
use App\Models\mapel;
use App\Http\Requests\StoreAsatidRequest;
use App\Http\Requests\UpdateAsatidRequest;

class AsatidController extends Controller
{

    public function index()
    {
        $asatid = Asatid::all();
        $asatidlist = Asatidlist::all();
        $mapel = Mapel::all();
        return view('asatid.asatid', compact('asatid', 'asatidlist', 'mapel'));

    }


    public function create()
    {
        $asatid = Asatid::all();
        $asatidlist = Asatidlist::all();
        $mapel = Mapel::all();
        return view('asatid.asatid', compact('asatid', 'asatidlist', 'mapel'));
    }


    public function store(StoreAsatidRequest $request)
    {
        $request->validate([
            'asatidlist_id' => 'required|unique:asatidlists,nama',
            'mapel_id' => 'required|unique:mapels,nama',
        ], [
            'asatidlist_id.required' => 'Kolom NAMA ASATID wajib diisi.',
            'asatidlist_id.unique' => 'NAMA ASATID sudah digunakan.',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'mapel_id.unique' => ' MAPEL sudah digunakan.',
        ]);
        Asatid::create([
            'asatidlist_id' => $request->input('asatidlist_id'),
            'mapel_id' => $request->input('mapel_id'),
        ]);

        return redirect()->route('asatid.index')->with('success', 'ASATID berhasil ditambahkan');

    }


    public function show(Asatid $asatid)
    {
        //
    }


    public function edit(Asatid $asatid)
    {
        $asatid = Asatid::all();
        $asatidlist = Asatidlist::all();
        $mapel = Mapel::all();
        return view('asatid.asatid', compact('asatid', 'asatidlist', 'mapel'));
    }


    public function update(UpdateAsatidRequest $request, Asatid $asatid)
    {
        $request->validate([
            'asatidlist_id' => 'required|unique:asatidlists,nama,' . $asatid->id,
            'mapel_id' => 'required|unique:mapels,nama,' . $asatid->id,
        ], [
            'asatidlist_id.required' => 'Kolom NAMA ASATID wajib diisi.',
            'asatidlist_id.unique' => 'NAMA ASATID sudah digunakan.',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'mapel_id.unique' => ' MAPEL sudah digunakan.',
        ]);
        return redirect()->route('asatid.index')->with('success', 'ASATID berhasil diupdate');
    }


    public function destroy(Asatid $asatid)
    {
        $asatid->delete();
        return redirect()->route('asatid.index')->with('success', 'ASATID berhasil dihapus');
    }
}
