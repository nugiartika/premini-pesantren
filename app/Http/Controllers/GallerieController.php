<?php

namespace App\Http\Controllers;

use App\Models\Gallerie;
use Illuminate\Support\Str;
use App\Http\Requests\StoreGallerieRequest;
use App\Http\Requests\UpdateGallerieRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class GallerieController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $cgallerie = $request->input('search');
            $gallerie = Gallerie::where('nama_gallery', 'LIKE', "%$cgallerie%")->paginate(5);
        } else {
            $gallerie = Gallerie::paginate(5);
        }

        return view('gallerie.gallerie', compact('gallerie'));
}



    public function create()
    {
        $gallerie = Gallerie::all();
        return view('gallerie.gallerie', compact('gallerie'));
    }


        public function store(StoreGallerieRequest $request, Gallerie $gallerie)
        {
            $request->validate([
                'nama_gallery' => 'required',
                'tanggal' => 'required|date|after_or_equal:today',
                'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
                'slug.required' => 'Kolom SLUG wajib diisi.',
                'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
                'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
                'tanggal.after_or_equal' => 'TANGGAL harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
                'sampul.required' => 'Kolom SAMPUL wajib diisi.',
                'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
                'sampul.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
                'sampul.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',

            ]);

            $data = $request->all();

            if ($request->hasFile('sampul')) {
                $foto = $request->file('sampul');
                $filename = Str::random(20) . '.' . $foto->getClientOriginalExtension();
                $data['foto'] = $foto->storeAs('public', $filename);
            }

            Gallerie::create($data);


            // $gambar = $request->file('sampul');
            // $path = Storage::disk('public')->put('images', $gambar);

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
            'tanggal' => 'required|date|after_or_equal:today',
            'sampul' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
            'sampul.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'sampul.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = Str::random(20) . '.' . $foto->getClientOriginalExtension();
            $path = $foto->storeAs('public', $filename); // Menyimpan gambar ke penyimpanan disk publik
            $data['foto'] = $path;

            if ($gallerie->foto) {
                Storage::disk('public')->delete($gallerie->foto);
            }
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
