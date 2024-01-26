<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Http\Requests\StoreKelulusanRequest;
use App\Http\Requests\UpdateKelulusanRequest;

class KelulusanController extends Controller
{

    public function index()
    {
        $kelulusan = Kelulusan::all();
        return view('kelulusan.kelulusan', compact('kelulusan'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelulusan = Kelulusan::all();
        return view('kelulusan.kelulusan', compact('kelulusan'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelulusanRequest $request)
    {
        $request->validate([
            'nama' => 'required|unique:kelulusans,nama',
            'no_ujian' => 'required|unique:kelulusans,no_ujian',
            'jurusan' => 'required',
            'mapel' => 'required',
        ], [
            'nama.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'nama.unique' => 'NAMA SANTRI sudah digunakan.',
            'no_ujian.required' => 'Kolom NON UJIAN wajib diisi.',
            'no_ujian.unique' => 'NO UJIAN sudah digunakan.',
            'jurusan.required' => 'Kolom JURUSAN wajib diisi.',
            'mapel.required' => 'Kolom MAPEL wajib diisi.',
        ]);

        Kelulusan::create([
            'nama' => $request->input('nama'),
            'no_ujian' => $request->input('no_ujian'),
            'jurusan' => $request->input('jurusan'),
            'mapel' => $request->input('mapel'),
        ]);

        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Kelulusan $kelulusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelulusan $kelulusan)
    {
        $kelulusan = Kelulusan::all();
        return view('kelulusan.kelulusan', compact('kelulusan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKelulusanRequest $request, Kelulusan $kelulusan)
    {
        $request->validate([
            'nama' => 'required|unique:kelulusans,nama',
            'no_ujian' => 'required|unique:kelulusans,no_ujian',
            'jurusan' => 'required',
            'mapel' => 'required',
        ], [
            'nama.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'nama.unique' => 'NAMA SANTRI sudah digunakan.',
            'no_ujian.required' => 'Kolom NON UJIAN wajib diisi.',
            'no_ujian.unique' => 'NO UJIAN sudah digunakan.',
            'jurusan.required' => 'Kolom JURUSAN wajib diisi.',
            'mapel.required' => 'Kolom MAPEL wajib diisi.',
        ]);
        $kelulusan->update([
            'nama' => $request->input('nama'),
            'no_ujian' => $request->input('no_ujian'),
            'jurusan' => $request->input('jurusan'),
            'mapel' => $request->input('mapel'),
        ]);
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN berhasil diupdate');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN berhasil dihapus');

    }
}
