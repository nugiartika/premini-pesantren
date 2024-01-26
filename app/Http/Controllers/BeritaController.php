<?php

namespace App\Http\Controllers;

use App\Models\berita;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{

    public function index()
    {
        $beritas = berita::all();
        $kategoris = Kategori::all();
        return view('berita.berita', compact('beritas','kategoris'));
    }


    public function create()
    {
        $kategori = Kategori::all();
        return view('berita.berita', compact('kategori'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required',
            'slug'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $gambar = $request->file('sampul');
        $path = Storage::disk('public')->put('images', $gambar);

        berita::create([
            'judul_berita' => $request->input('judul_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'sampul' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berhasil menambahkan data');
    }


    public function show(berita $berita)
    {
//
    }


    public function edit(berita $berita)
    {
    $berita = berita::all();
        return view('berita.berita', compact('berita'));

    }


    public function update(Request $request, berita $berita)
    {
         $request->validate([
            'nama_berita' => 'required',
            'slug'  => 'required',
            'kategori_id'  => 'required',
            'tanggal' => 'required',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('sampul')){
            $gambar = $request->file('sampul');
            $path = $gambar->store('images','public');
            $berita->update(['sampul' => $path]);
        }

        $berita->update([
            'nama_berita' => $request->input('nama_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'sampul' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'Berhasil mengubah data');

    }


    public function destroy(berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'berita berhasil dihapus');
    }
}
