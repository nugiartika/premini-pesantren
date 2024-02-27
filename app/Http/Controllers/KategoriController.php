<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\KategoriRequest;
use Illuminate\Http\Request;


class KategoriController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $ckategori = $request->input('search');
            $kategori = kategori::where('nama', 'LIKE', "%$ckategori%")->paginate(5);
        } else {
            $kategori = kategori::paginate(5);
        }
        return view('kategori.kategori', compact('kategori'));
    }


    public function create()
    {
        $kategori = kategori::all();
        return view('kategori.kategori', compact('kategori'));
    }


    public function store(KategoriRequest $request)
    {
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




    public function update(KategoriRequest $request, Kategori $kategori)
    {
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
