<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\mapel;
use App\Models\santri;
use App\Http\Requests\StoreKelulusanRequest;
use App\Http\Requests\UpdateKelulusanRequest;

class KelulusanController extends Controller
{

    public function index()
    {
        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKelulusanRequest $request)
    {
        $request->validate([
            'santri_id' => 'required|unique:kelulusans,santri_id',
            'no_ujian' => 'required|numeric|min:0|unique:kelulusans,no_ujian',
            'mapel_id' => 'required',
            'nilai' => 'required|numeric|min:0',
        ], [
            'santri_id.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'santri_id.unique' => 'NAMA SANTRI sudah digunakan.',
            'no_ujian.required' => 'Kolom NON UJIAN wajib diisi.',
            'no_ujian.numeric' => 'NO UJIAN harus berupa angka',
            'no_ujian.min' => 'NO UJIAN tidak boleh MIN-',
            'no_ujian.unique' => 'NO UJIAN sudah digunakan.',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'nilai.required' => 'Kolom NILAI wajib diisi.',
            'nilai.numeric' => ' NILAI harus berupa angka',
            'nilai.min' => ' NILAI tidak boleh MIN-',
        ]);

        $nilai = $request->input('nilai');
        $keterangan = ($nilai >= 80) ? 'Lulus' : 'Tidak Lulus';

        Kelulusan::create([
            'santri_id' => $request->input('santri_id'),
            'no_ujian' => $request->input('no_ujian'),
            'mapel_id' => $request->input('mapel_id'),
            'nilai' => $nilai,
            'keterangan' => $keterangan,
         ]);

        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DITAMBAHKAN');

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
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }


    public function update(UpdateKelulusanRequest $request, Kelulusan $kelulusan)
    {
        $request->validate([
            'santri_id' => 'required|unique:kelulusans,santri_id,' . $kelulusan->id,
            'no_ujian' => 'required|numeric|min:0|unique:kelulusans,no_ujian,' . $kelulusan->id,
            'mapel_id' => 'required',
            'nilai' => 'required|numeric|min:0',
            // 'keterangan' => 'required',
        ], [
            'santri_id.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'santri_id.unique' => 'NAMA SANTRI sudah digunakan.',
            'no_ujian.required' => 'Kolom NON UJIAN wajib diisi.',
            'no_ujian.numeric' => 'NO UJIAN harus berupa angka',
            'no_ujian.min' => 'NO UJIAN tidak boleh MIN-',
            'no_ujian.unique' => 'NO UJIAN sudah digunakan.',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'nilai.required' => 'Kolom NILAI wajib diisi.',
            'nilai.numeric' => ' NILAI harus berupa angka',
            'nilai.min' => ' NILAI tidak boleh MIN-',
            // 'keterangan.required' => 'Kolom KETERANGAN wajib diisi.',
        ]);

        $nilai = $request->input('nilai');
        $keterangan = ($nilai >= 80) ? 'Lulus' : 'Tidak Lulus';

        $kelulusan->update([
            'santri_id' => $request->input('santri_id'),
            'no_ujian' => $request->input('no_ujian'),
            'mapel_id' => $request->input('mapel_id'),
            'nilai' => $nilai,
            'keterangan' => $keterangan,
        ]);
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIUPDATE');

    }

    
    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIHAPUS');
    }
}
