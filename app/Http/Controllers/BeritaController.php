<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Kategori;
use Carbon\Carbon;
use App\Http\Requests\BeritaRequest;
use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use DOMDocument;
use DOMDocument;


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


    public function store(BeritaRequest $request)
    {
        $isi = $request->input('isi');

        $dom = new DOMDocument();
        $dom->loadHTML($isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', $img->getAttribute('src'))[1]);

            $images_name = "images/" . time() . $key . '.png';

            Storage::disk('public')->put($images_name, $data);

            $img->removeAttribute('src');

            $img->setAttribute('src', asset('storage/' . $images_name));
        }

        $isi = $dom->saveHTML();

        Berita::create([
            'judul_berita' => $request->input('judul_berita'),
            'isi' => $isi,
            'kategori_id' => $request->input('kategori_id'),
            'tanggal' => $request->input('tanggal'),
        ]);

        return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DITAMBAHKAN');
    }


    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('berita.berita', compact('berita'));
    }


    public function edit($id)
    {
        $berita = Berita::find($id);
        $kategori = Kategori::all();
        return view('berita.edit', compact('berita', 'kategori'));
    }


    public function update(BeritaRequest $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $isi = $request->input('isi');

        $dom = new DOMDocument();
        $dom->loadHTML($isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

        $images = $dom->getElementsByTagName('img');
        foreach ($images as $key => $img) {
            $data = base64_decode(explode(',', $img->getAttribute('src'))[1]);

            $images_name = "images/" . time() . $key . '.png';

            Storage::disk('public')->put($images_name, $data);

            $img->removeAttribute('src');

            $img->setAttribute('src', asset('storage/' . $images_name));
        }

        $isi = $dom->saveHTML();

        $oldPhotoPath = $berita->foto;

        $data = [
            'judul_berita' => $request->input('judul_berita'),
            'isi' => $isi,
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


    public function destroy($id)
    {
        try {
            $berita = Berita::findOrFail($id);

            $dom = new DOMDocument();
            $dom->loadHTML($berita->isi, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

            $images = $dom->getElementsByTagName('img');

            foreach ($images as $img) {
                $path = $img->getAttribute('src');
                if (Storage::disk('public')->exists($path)) {
                    Storage::disk('public')->delete($path);
                }
            }

            $berita->delete();

            return redirect()->route('berita.index')->with('success', 'BERITA BERHASIL DIHAPUS');
        } catch (Exception $e) {
            return redirect()->route('berita.index')->with('error', 'GAGAL MENGHAPUS BERITA. PESAN KESALAHAN: ' . $e->getMessage());
        }
    }

}
