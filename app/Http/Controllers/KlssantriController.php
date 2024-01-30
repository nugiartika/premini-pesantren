<?php

namespace App\Http\Controllers;

use App\Models\Klssantri;
use App\Models\Asatidlist;
use Illuminate\Http\Request;

class KlssantriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $klssantri = Klssantri::all();
        $asatidlist = Asatidlist::all();
        return view('klssantri.klssantri', compact('klssantri', 'asatidlist'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $klssantri = Klssantri::all();
        $asatidlist = Asatidlist::all();
        return view('klssantri.klssantri', compact('klssantri', 'asatidlist'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:klssantris,nama_kelas',
            'asatidlist_id' => 'required',
        ], [
            'nama_kelas.required' => 'Kolom NAMA KELAS wajib diisi.',
            'nama_kelas.unique' => 'NAMA KELAS sudah digunakan.',
            'asatidlist_id.required' => 'Kolom WALI KELAS wajib diisi.',
        ]);

        Klssantri::create([
            'nama_kelas' => $request->input('nama_kelas'),
            'asatidlist_id' => $request->input('asatidlist_id'),
        ]);

        return redirect()->route('klssantri.index')->with('success', 'KELAS BERHASIL DITAMBAHKAN');
    }

    /**
     * Display the specified resource.
     */
    public function show(Klssantri $klssantri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Klssantri $klssantri)
    {
        $klssantri = Klssantri::all();
        $asatidlist = Asatidlist::all();
        return view('klssantri.klssantri', compact('klssantri', 'asatidlist'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Klssantri $klssantri)
    {
        $request->validate([
            'nama_kelas' => 'required|unique:klssantris,nama_kelas,' . $klssantri->id,
            'asatidlist_id' => 'required',
        ], [
            'nama_kelas.required' => 'Kolom NAMA KELAS wajib diisi.',
            'nama_kelas.unique' => 'NAMA KELAS sudah digunakan.',
            'asatidlist_id.required' => 'Kolom WALI KELAS wajib diisi.',

        ]);

        $klssantri->update([
            'nama_kelas' => $request->input('nama_kelas'),
            'asatidlist_id' => $request->input('asatidlist_id'),
        ]);

        return redirect()->route('klssantri.index')->with('success', 'KELAS BERHASIL DIUPDATE');
    }


    public function destroy(Klssantri $klssantri)
    {
        if ($klssantri->santri ()->exists()) {
            return redirect()->route('klssantri.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $klssantri->delete();
        return redirect()->route('klssantri.index')->with('success', 'KELAS BERHASIL DIHAPUS');
    }
}
