<?php

namespace App\Http\Controllers;

use App\Models\santri;
use App\Models\klssantri;
use Carbon\Carbon;
use App\Http\Requests\StoresantriRequest;
use App\Http\Requests\UpdatesantriRequest;

class SantriController extends Controller
{

    public function index()
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        return view('santri.santri', compact('santri','klssantri'));
    }


    public function create()
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        return view('santri.santri', compact('santri','klssantri'));
    }


    public function store(StoresantriRequest $request)
    {
        $request->validate([
            'nis' => 'required|numeric|min:0|unique:santris,nis',
            'nama' => 'required|unique:santris,nama',
            'klssantri_id' => 'required',
            'alamat' => 'required',
            'ttl' => 'required|date|before:tomorrow',
            'jns_kelamin' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.min' => 'NIS tidak boleh MIN-',
            'nis.unique' => ' sudah NIS digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => ' sudah NAMA digunakan.',
            'klssantri_id.required' => 'Kolom KELAS wajib diisi',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'jns_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
        ]);
        Santri::create([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'klssantri_id' => $request->input('klssantri_id'),
            'alamat' => $request->input('alamat'),
            'ttl' => $request->input('ttl'),
            'jns_kelamin' => $request->input('jns_kelamin'),
        ]);

        return redirect()->route('santri.index')->with('success', 'SANTRI BERHASIL DITAMBAHKAN');

    }


    public function show(santri $santri)
    {
        //
    }


    public function edit(santri $santri)
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        return view('santri.santri', compact('santri','klssantri'));
    }


    public function update(UpdatesantriRequest $request, santri $santri)
    {
        $request->validate([
            'nis' => 'required|numeric|min:0|unique:santris,nis,' . $santri->id,
            'nama' => 'required|unique:santris,nama,' . $santri->id,
            'klssantri_id' => 'required',
            'alamat' => 'required',
            'ttl' => 'required|date|before:tomorrow',
            'jns_kelamin' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.min' => 'NIS tidak boleh MIN-',
            'nis.unique' => ' sudah NIS digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => ' sudah NAMA digunakan.',
            'klssantri_id.required' => 'Kolom KELAS wajib diisi.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'jns_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
        ]);
        $santri->update([
            'nis' => $request->input('nis'),
            'nama' => $request->input('nama'),
            'klssantri_id' => $request->input('klssantri_id'),
            'alamat' => $request->input('alamat'),
            'ttl' => $request->input('ttl'),
            'jns_kelamin' => $request->input('jns_kelamin'),

        ]);

        return redirect()->route('santri.index')->with('success', 'SANTRI BERHASIL DIUPDATE');

    }


    public function destroy(santri $santri)
    {
        if ($santri->kelulusan ()->exists()|| $santri->syahriah()->exists()) {
            return redirect()->route('santri.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $santri->delete();
        return redirect()->route('santri.index')->with('success', 'SANTRI BERHASIL DIHAPUS');
    }
}
