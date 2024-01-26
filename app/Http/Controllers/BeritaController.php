<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;

class BeritaController extends Controller
{

    public function index()
    {
        $berita = Berita::all();
        $kategori = Kategori::all();
        return view('berita.berita', compact('berita','kategori'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $berita = Berita::all();
        $kategori = Kategori::all();
        return view('berita.berita', compact('berita','kategori'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBeritaRequest $request)
    {
        $request->validate([
            'judul_berita' => 'required',
            'slug'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $foto = $request->file('foto');
        $path = Storage::disk('public')->put('images', $foto);

        Berita::create([
            'judul_berita' => $request->input('judul_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'sampul' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data');
    }


    public function show(Berita $berita)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Berita $berita)
    {
        $berita = Berita::all();
        $kategori = Kategori::all();
        return view('berita.berita', compact('berita','kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        $request->validate([
            'judul_berita' => 'required',
            'slug'  => 'required',
            'kategori_id'  => 'required',
            'tanggal' => 'required',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            $staf->update(['foto' => $path]);
        }

        $berita->update([
            'judul_berita' => $request->input('judul_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'sampul' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berhasil mengubah data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'BERITA berhasil dihapus');
    }
}
