<?php

namespace App\Http\Controllers;

use App\Models\santri;
use App\Http\Requests\StoresantriRequest;
use App\Http\Requests\UpdatesantriRequest;
use App\Models\kelas;

class SantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $santri = Santri::all();
        $kelas = kelas::all();
        return view('santri.santri', compact('santri','kelas'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // $santri = Santri::all();
        $kelas = kelas::all();
        // return view('santri.santri', compact('santri','kelas'));
        return view('santri.create', compact('kelas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoresantriRequest $request)
    {
        $request->validate([
            'nis' => 'required|unique:santris,nis',
            'nama' => 'required|unique:santris,nama',
            'kelas_id' => 'required',
            'alamat' => 'required',
            'ttl' => 'required',
            'jns_kelamin' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.unique' => ' sudah NIS digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => ' sudah NAMA digunakan.',
            'kelas_id.required' => 'Kolom kelas wajib diisi',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'ttl.required' => 'Kolom wajib diisi.',
            'jns_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
        ]);
        Santri::create([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'ttl' => $request->input('ttl'),
            'jns_kelamin' => $request->input('jns_kelamin'),
        ]);

        return redirect()->route('santri.index')->with('success', 'SANTRI berhasil ditambahkan');

    }


    public function show(santri $santri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(santri $santri)
    {
        $santri = Santri::all();
        return view('santri.santri', compact('santri'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatesantriRequest $request, santri $santri)
    {
        $request->validate([
            'nis' => 'required|unique:santris,nis,' . $santri->id,
            'nama' => 'required|unique:santris,nama,' . $santri->id,
            'kelas_id' => 'required',
            'alamat' => 'required',
            'ttl' => 'required',
            'jns_kelamin' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.unique' => ' sudah NIS digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => ' sudah NAMA digunakan.',
            'kelas_id.required' => 'Kolom KELAS wajib diisi.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'ttl.required' => 'Kolom wajib diisi.',
            'jns_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
        ]);
        $santri->update([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'kelas_id' => $request->input('kelas_id'),
            'alamat' => $request->input('alamat'),
            'ttl' => $request->input('ttl'),
            'jns_kelamin' => $request->input('jns_kelamin'),

        ]);

        return redirect()->route('santri.index')->with('success', 'SANTRI berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(santri $santri)
    {
        $santri->delete();
        return redirect()->route('santri.index')->with('success', 'SANTRI berhasil dihapus');

    }
}
