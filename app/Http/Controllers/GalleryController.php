<?php

namespace App\Http\Controllers;

use App\Models\gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = gallery::all();
        return view('gallery.gallery', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $galleries = gallery::all();
        return view('gallery.gallery', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
        $filename = Str::random(20) . '.' . $gambar->getClientOriginalExtension();
        Storage::disk('public')->put('images/' . $filename, file_get_contents($gambar));

        gallery::create($request->all());

        return redirect()->route('gallery.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(gallery $gallery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(gallery $gallery)
    {
        $gallery = gallery::all();
        return view('gallery.gallery', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
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

        return redirect()->route('gallery.index')->with('success', 'Berhasil mengubah data');

        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(gallery $gallery)
    {
        $gallery->delete();
        return redirect()->route('gallery.index')->with('success', 'gallery berhasil dihapus');
    }
}
