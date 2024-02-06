<?php

namespace App\Http\Controllers;

use App\Models\Gallerie;
use App\Http\Requests\StoreGallerieRequest;
use App\Http\Requests\UpdateGallerieRequest;
use Illuminate\Support\Facades\Storage;

class GallerieController extends Controller
{

    public function index()
    {
        $gallerie = Gallerie::all();
        return view('gallerie.gallerie', compact('gallerie'));
    }


    public function create()
    {
        $gallerie = Gallerie::all();
        return view('gallerie.gallerie', compact('gallerie'));
    }


    public function store(StoreGallerieRequest $request)
    {
        $request->validate([
            'nama_gallery' => 'required',
            // 'slug'  => 'required',
            'tanggal' => 'required|date',
            'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
            'slug.required' => 'Kolom SLUG wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'sampul.required' => 'Kolom SAMPUL wajib diisi.',
            'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
            'sampul.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'sampul.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',

        ]);


        $gambar = $request->file('sampul');
        $path = Storage::disk('public')->put('images', $gambar);

        Gallerie::create([
            'nama_gallery' => $request->input('nama_gallery'),
            // 'slug' => $request->input('slug'),
            'tanggal' => $request->input('tanggal'),
            'sampul' => $path,
        ]);

        return redirect()->route('gallerie.index')->with('success', 'GALLERY BERHASIL DITAMBAHKAN');
    }


    public function show(Gallerie $gallerie)
    {
        //
    }


    public function edit(Gallerie $gallerie)
    {
        $gallerie = Gallerie::all();
        return view('gallerie.gallerie', compact('gallerie'));
    }


    public function update(UpdateGallerieRequest $request, Gallerie $gallerie)
    {
        $request->validate([
            'nama_gallery' => 'required',
            // 'slug'  => 'required',
            'tanggal' => 'required|date',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
            // 'slug.required' => 'Kolom SLUG wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            // 'sampul.required' => 'Kolom SAMPUL wajib diisi.',
            'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
            'sampul.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'sampul.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);


        $data = [
            'nama_gallery' => $request->input('nama_gallery'),
            // 'slug' => $request->input('slug'),
            'tanggal' => $request->input('tanggal'),
        ];

        if($request->hasFile('sampul')){
            $gambar = $request->file('sampul');
            $path = $gambar->store('images','public');
            $data['sampul'] = $path;
        }

        $gallerie->update($data);

        return redirect()->route('gallerie.index')->with('success', 'GALLERY BERHASIL DIUPDATE');
    }


    public function destroy(Gallerie $gallerie)
    {
        $gallerie->delete();
        return redirect()->route('gallerie.index')->with('success', 'GALLERY BERHASIL DIHAPUS');
    }
}
