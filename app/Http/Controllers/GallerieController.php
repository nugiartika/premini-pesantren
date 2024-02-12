<?php

namespace App\Http\Controllers;

use App\Models\Gallerie;
use Carbon\Carbon;
use App\Http\Requests\StoreGallerieRequest;
use App\Http\Requests\UpdateGallerieRequest;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
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
        return view('gallerie.create', compact('gallerie'));
    }


        public function store(StoreGallerieRequest $request, Gallerie $gallerie)
        {
            $request->validate([
                'nama_gallery' => 'required',
                'tanggal' => 'required|date|after_or_equal:today',
                'user_posting' => 'required',
                'sampul' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required',
            ], [
                'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
                'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
                'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
                'tanggal.after_or_equal' => 'TANGGAL harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
                'user_posting.required' => 'Kolom USER POSTING wajib diisi.',
                'sampul.required' => 'Kolom SAMPUL wajib diisi.',
                'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
                'sampul.mimes' => 'Format SAMPUL tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
                'sampul.max' => 'Ukuran SAMPUL tidak boleh lebih dari 2 MB.',
                'status.required' => 'Kolom STATUS wajib diisi.',
            ]);

            $sampul = $request->file('sampul');
            $path = Storage::disk('public')->put('images', $sampul);

            Gallerie::create([
                'nama_gallery' => $request->input('nama_gallery'),
                'tanggal' => $request->input('tanggal'),
                'user_posting' => $request->input('user_posting'),
                'sampul' => isset($path) ? Storage::url($path) : null,
                'status' => $request->input('status'),
            ]);

            return redirect()->route('gallerie.index')->with('success', 'GALLERY BERHASIL DITAMBAHKAN');
        }


        public function show($id)
        {
            $gallerie = Gallerie::findOrFail($id);
            $userRole = auth()->user()->role;
            return view('gallerie.gallerie', compact('gallerie','userRole'));
        }


    public function edit($id)
    {
        $gallerie = Gallerie::find($id);
        return view('gallerie.edit', compact('gallerie'));
    }


    public function update(UpdateGallerieRequest $request, $id)
    {
        $gallerie = Gallerie::findOrFail($id);

        $request->validate([
            'nama_gallery' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'user_posting' => 'required',
            'sampul' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ], [
            'nama_gallery.required' => 'Kolom NAMA GALLERY wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'user_posting.required' => 'Kolom USER POSTING wajib diisi.',
            'sampul.required' => 'Kolom SAMPUL wajib diisi.',
            'sampul.image' => 'Kolom SAMPUL harus berupa file gambar.',
            'sampul.mimes' => 'Format SAMPUL tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'sampul.max' => 'Ukuran SAMPUL tidak boleh lebih dari 2 MB.',
            'status.required' => 'Kolom STATUS wajib diisi.',
        ]);

    $oldPhotoPath = $gallerie->sampul;

    $data = [
        'nama_gallery' => $request->input('nama_gallery'),
        'tanggal' => $request->input('tanggal'),
        'user_posting' => $request->input('user_posting'),
        'status' => $request->input('status'),
    ];

     if ($request->hasFile('sampul')) {
        $sampul = $request->file('sampul');
        $path = $sampul->store('images', 'public');
        $data['sampul'] = $path;
    }

        $gallerie->update($data);

        if ($gallerie->wasChanged('sampul') && $oldPhotoPath) {
            Storage::disk('public')->delete($oldPhotoPath);
            $localFilePath = public_path('storage/' . $oldPhotoPath);
            if (File::exists($localFilePath)) {
                File::delete($localFilePath);
            }
        }
        return redirect()->route('gallerie.index')->with('success', 'GALLERY BERHASIL DIUPDATE');
    }


    public function destroy(Gallerie $gallerie)
    {
        try {

         if (Storage::disk('public')->exists($gallerie->sampul)) {

            Storage::disk('public')->delete($gallerie->sampul);
        }

        $localFilePath = public_path('storage/' . $gallerie->sampul);
        if (File::exists($localFilePath)) {

            File::delete($localFilePath);
        }

        $gallerie->delete();

        return redirect()->route('gallerie.index')->with('success', 'GALLERY BERHASIL DIHAPUS');
    } catch (Exception $th) {
        return redirect()->route('gallerie.index')->with('error', 'GAGAL MENGHAPUS GALLERY. PESAN KESALAHAN: ' . $th->getMessage());
    }
}
}
