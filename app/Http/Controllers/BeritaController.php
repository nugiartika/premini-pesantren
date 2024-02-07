<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use App\Http\Requests\StoreBeritaRequest;
use App\Http\Requests\UpdateBeritaRequest;
use Illuminate\Support\Facades\Storage;
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
        return view('berita.berita', compact('berita','kategori'));
    }


    public function store(StoreBeritaRequest $request)
    {
        $request->validate([
            'judul_berita' => 'required|unique:beritas,judul_berita',
            'slug'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'user_posting' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'status' => 'required',
        ], [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'slug.required' => 'Kolom SLUG wajib diisi.',
            'kategori_id.unique' => 'KATEGORI sudah digunakan.',
            'tanggal.required' => 'Kolom TANGGAL BERITA wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL BERITA harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL BERITA harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
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
            'foto' => $path,
            'user_posting'=> $request->input('user_posting'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DITAMBAHKAN');
    }

    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        $userRole = auth()->user()->role;
        return view('berita.berita', compact('berita','userRole'));
    }


    public function edit(Berita $berita)
    {
        $berita = Berita::all();
        $kategori = Kategori::all();
        return view('berita.berita', compact('berita','kategori'));
    }


    public function update(UpdateBeritaRequest $request, Berita $berita)
    {
        $request->validate([
            'judul_berita' => 'required|unique:beritas,judul_berita,' . $berita->id,
            'slug'  => 'required',
            'kategori_id' => 'required',
            'tanggal' => 'required|date|after_or_equal:today',
            'user_posting' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required',
        ], [
            'judul_berita.required' => 'Kolom JUDUL BERITA wajib diisi.',
            'judul_berita.unique' => 'JUDUL BERITA sudah digunakan.',
            'slug.required' => 'Kolom SLUG wajib diisi.',
            'kategori_id.unique' => 'KATEGORI sudah digunakan.',
            'tanggal.required' => 'Kolom TANGGAL BERITA wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL BERITA harus berupa tanggal.',
            'tanggal.after_or_equal' => 'TANGGAL BERITA harus berisi tanggal yang sama dengan hari ini/terbaru.',            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'user_posting.required' => 'user posting tidak boleh kosong',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $data = [
            'judul_berita' => $request->input('judul_berita'),
            'slug' => $request->input('slug'),
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
            'user_posting' => $request->input('user_posting'),
            'status' => $request->input('status'),
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            $data['foto'] = $path;

        }


        $berita->update($data);

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIUPDATE');
    }


    public function destroy(Berita $berita)
    {
        $berita->delete();
        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIHAPUS');
    }
}
