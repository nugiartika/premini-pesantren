<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Support\Facades\Storage;

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
            'judul_berita' => 'required|unique:beritas,judul_berita',
            'slug'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after:yesterday',
            'user_posting' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'slug.required' => 'Kolom SLUG wajib diisi.',
            'kategori_id.unique' => 'KATEGORI sudah digunakan.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'tanggal.after' => 'Kolom TANGGAL tidak boleh sebelum dari hari ini.',
            'user_posting.required' => 'Kolom USER POSTING wajib diisi.',
            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);

        $foto = $request->file('foto');
        $path = Storage::disk('public')->put('images', $foto);

        Berita::create([
            'judul_berita' => $request->input('judul_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'foto' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DITAMBAHKAN');
    }
    /**
     * Display the specified resource.
     */
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
            'judul_berita' => 'required|unique:beritas,judul_berita,' . $berita->id,
            'slug'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'user_posting' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'slug.required' => 'Kolom SLUG wajib diisi.',
            'kategori_id.unique' => 'KATEGORI sudah digunakan.',
            'tanggal.required' => 'Kolom TANGGAL wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL harus berupa tanggal.',
            'tanggal.after_or_equal' => 'Kolom TANGGAL tidak boleh sebelum dari hari ini.',
            'user_posting.required' => 'Kolom USER POSTING wajib diisi.',
            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            // $staf->update(['foto' => $path]);
        }

        $berita->update([
            'judul_berita' => $request->input('judul_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'foto' => $path,
        ]);

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIUPDATE');
    }


    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIHAPUS');
    }
}
