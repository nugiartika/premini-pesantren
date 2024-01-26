<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
// use Illuminate\Support\Str;


class GalleryController extends Controller
{

    public function index()
    {
        $galleries = gallery::all();
        return view('gallery.gallery', compact('galleries'));
    }

    
    public function create()
    {
        $galleries = gallery::all();
        return view('gallery.gallery', compact('galleries'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'nama_gallery' => 'required',
            'slug'  => 'required',
            'tanggal' => 'required',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);


        $gambar = $request->file('sampul');
        $path = Storage::disk('public')->put('images', $gambar);

        gallery::create([
            'nama_gallery' => $request->input('nama_gallery'),
            'slug' => $request->input('slug'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'sampul' => $path,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Berhasil menambahkan data');
    }


    public function show(gallery $gallery)
    {
        //
    }


    public function edit(gallery $gallery)
    {
        $gallery = gallery::all();
        return view('gallery.gallery', compact('gallery'));
    }


    public function update(Request $request, gallery $gallery)
    {
        $request->validate([
            'nama_gallery' => 'required',
            'slug'  => 'required',
            'tanggal' => 'required',
            'user_posting' => 'required',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($request->hasFile('sampul')){
            $gambar = $request->file('sampul');
            $path = $gambar->store('images','public');
            $gallery->update(['sampul' => $path]);
        }

        $gallery->update([
            'nama_gallery' => $request->input('nama_gallery'),
            'slug' => $request->input('slug'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'sampul' => $path,
        ]);

        return redirect()->route('gallery.index')->with('success', 'Berhasil mengubah data');


    }


    public function destroy(gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'gallery berhasil dihapus');
    }
}
