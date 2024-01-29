<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;

class KategoriController extends Controller
{

    public function index()
    {
        $kategori = kategori::all();
        return view('kategori.kategori', compact('kategori'));
    }


    public function create()
    {
        $kategori = kategori::all();
        return view('kategori.kategori', compact('kategori'));
    }


    public function store(StoreKategoriRequest $request)
    {
        $request->validate([
            'nama' => 'required|unique:kategoris,nama',
        ], [
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => 'NAMA sudah digunakan.',
        ]);

        Kategori::create([
            'nama' => $request->input('nama'),
        ]);

        return redirect()->route('kategori.index')->with('success', 'KATEGORI BERHASIL DITAMBAHKAN');

    }


    public function show(Kategori $kategori)
    {

    }


    public function edit(Kategori $kategori)
    {
        $kategori = kategori::all();
        return view('kategori.kategori', compact('kategori'));
    }




    public function update(UpdateKategoriRequest $request, Kategori $kategori)
    {
        $request->validate([
            'nama' => 'required|unique:kategoris,nama,' . $kategori->id,
        ], [
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => 'NAMA sudah digunakan.',
        ]);

        $kategori->update([
            'nama' => $request->input('nama'),
        ]);
        return redirect()->route('kategori.index')->with('success', 'KATEGORI BERHASIL DIUPDATE');
    }


    public function destroy(Kategori $kategori)
    {
        if ($kategori->berita ()->exists()) {
            return redirect()->route('kategori.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $kategori->delete();
        return redirect()->route('kategori.index')->with('success', 'KATEGORI BERHASIL DIHAPUS');
    }
}
