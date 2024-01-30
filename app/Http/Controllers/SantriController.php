<?php

namespace App\Http\Controllers;

use App\Models\santri;
use App\Models\klssantri;
use App\Models\pendaftaran;
use Carbon\Carbon;
use App\Http\Requests\StoresantriRequest;
use App\Http\Requests\UpdatesantriRequest;

class SantriController extends Controller
{

    public function index()
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        $pendaftaran = pendaftaran::all();
        return view('santri.santri', compact('santri', 'klssantri', 'pendaftaran'));
    }


    public function create()
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        $pendaftaran = pendaftaran::all();
        return view('santri.santri', compact('santri', 'klssantri', 'pendaftaran'));
    }


    public function store(StoresantriRequest $request)
    {
        $request->validate([
            'nis' => 'required|numeric|min:0|unique:santris,nis',
            'pendaftaran_id' => 'required',
            'klssantri_id' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.min' => 'NIS tidak boleh MIN-',
            'nis.unique' => ' sudah NIS digunakan.',
            'pendaftaran_id.required' => 'Kolom NAMA SANTRI wajib diisi',
            'klssantri_id.required' => 'Kolom KELAS wajib diisi',
        ]);
        Santri::create([
            'nis' => $request->input('nis'),
            'pendaftaran_id' => $request->input('pendaftaran_id'),
            'klssantri_id' => $request->input('klssantri_id'),
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
        $pendaftaran = pendaftaran::all();
        return view('santri.santri', compact('santri', 'klssantri', 'pendaftaran'));
    }


    public function update(UpdatesantriRequest $request, santri $santri)
    {
        $request->validate([
            'nis' => 'required|numeric|min:0|unique:santris,nis,' . $santri->id,
            'pendaftaran_id' => 'required',
            'klssantri_id' => 'required',
        ], [
            'nis.required' => 'Kolom NIS wajib diisi.',
            'nis.numeric' => 'NIS harus berupa angka',
            'nis.min' => 'NIS tidak boleh MIN-',
            'nis.unique' => ' sudah NIS digunakan.',
            'pendaftaran_id.required' => 'Kolom NAMA SANTRI wajib diisi',
            'klssantri_id.required' => 'Kolom KELAS wajib diisi',

        ]);
        $santri->update([
            'nis' => $request->input('nis'),
            'pendaftaran_id' => $request->input('pendaftaran_id'),
            'klssantri_id' => $request->input('klssantri_id'),
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
