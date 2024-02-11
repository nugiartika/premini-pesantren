<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class BeritaController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $cberita = $request->input('search');
            $berita = Berita::where('judul_berita', 'LIKE', "%$cberita%")->paginate(5);
        } else {
            $berita = Berita::paginate(5);
        }
        $kategori = Kategori::all();
        return view('berita.berita', compact('berita','kategori'));
    }

    public function create()
    {
        $berita = Berita::all();
        $kategori = Kategori::all();
        return view('berita.create', compact('kategori'));
    }


    public function store(StoreBeritaRequest $request)
    {
        $request->validate([
            'judul_berita' => 'required|unique:beritas,judul_berita',
            'isi'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'isi.required' => 'Kolom ISI BERITA wajib diisi.',
            'kategori_id.required' => 'Kolom KATEGORI BERITA wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL BERITA wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL BERITA harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL BERITA harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO harus berupa file gambar.',
            'foto.mimes' => 'Format FOTO tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran FOTO tidak boleh lebih dari 2 MB.',
        ]);

        $foto = $request->file('foto');
        $path = Storage::disk('public')->put('images', $foto);

        Berita::create([
            'judul_berita' => $request->input('judul_berita'),
            'isi' => $request->input('isi'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'foto' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DITAMBAHKAN');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $userRole = auth()->user()->role;
        return view('berita.berita', compact('berita','userRole'));
    }


    public function edit($id)
    {
        $berita = Berita::find($id);
        $kategori = Kategori::all();
        return view('berita.edit', compact('berita', 'kategori'));
    }


    public function update(UpdateBeritaRequest $request, $id)
    {
        $berita = Berita::findOrFail($id);
        $request->validate([
            'judul_berita' => 'required|unique:beritas,judul_berita,' . $berita->id,
            'isi'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'isi.required' => 'Kolom ISI BERITA wajib diisi.',
            'kategori_id.required' => 'Kolom KATEGORI BERITA wajib diisi.',
            'tanggal.required' => 'Kolom TANGGAL BERITA wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL BERITA harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL BERITA harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO harus berupa file gambar.',
            'foto.mimes' => 'Format FOTO tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran FOTO tidak boleh lebih dari 2 MB.',
        ]);



        $oldPhotoPath = $berita->foto;

        $data = [
            'judul_berita' => $request->input('judul_berita'),
            'isi' => $request->input('isi'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            $data['foto'] = $path;

        }

        $berita->update($data);

        if ($berita->wasChanged('foto') && $oldPhotoPath) {
            Storage::disk('public')->delete($oldPhotoPath);

            $localFilePath = public_path('storage/' . $oldPhotoPath);
            if (File::exists($localFilePath)) {
                File::delete($localFilePath);
            }
        }

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIUPDATE');
    }


    public function destroy(Berita $berita)
    {
        try {

            if (Storage::disk('public')->exists($berita->foto)) {

               Storage::disk('public')->delete($berita->foto);
           }

           $localFilePath = public_path('storage/' . $berita->sampul);
           if (File::exists($localFilePath)) {

               File::delete($localFilePath);
           }

           $berita->delete();

           return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIHAPUS');
       } catch (Exception $th) {
           return redirect()->route('berita.index')->with('error', 'GAGAL MENGHAPUS BERITA. PESAN KESALAHAN: ' . $th->getMessage());
       }
       }
}
