<?php

namespace App\Http\Controllers;

use App\Models\Asatidlist;
use App\Http\Requests\StoreAsatidlistRequest;
use App\Http\Requests\UpdateAsatidlistRequest;

class AsatidlistController extends Controller
{

    public function index()
    {
        $asatidlist = Asatidlist::all();
        return view('asatidlist.asatidlist', compact('asatidlist'));

    }


    public function create()
    {
        $asatidlist = Asatidlist::all();
        return view('asatidlist.asatidlist', compact('asatidlist'));

    }


    public function store(StoreAsatidlistRequest $request)
    {
        $request->validate([
            'nip' => 'required|unique:asatidlists,nip',
            'nama' => 'required|unique:asatidlists,nama',
            'ttl' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => 'NAMA sudah digunakan.',
            'ttl.required' => 'Kolom ttl wajib diisi.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);
        $foto = $request->file('foto');
        $path = Storage::disk('public')->put('images', $foto);

        Asatidlist::create([
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'foto' => $path,
        ]);

        return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID berhasil ditambahkan');

    }


    public function show(Asatidlist $asatidlist)
    {
        //
    }


    public function edit(Asatidlist $asatidlist)
    {
        $asatidlist = Asatidlist::all();
        return view('asatidlist.asatidlist', compact('asatidlist'));
    }


    public function update(UpdateAsatidlistRequest $request, Asatidlist $asatidlist)
    {
        $request->validate([
            'nip' => 'required|unique:asatidlists,nip,' . $asatidlist->id,
            'nama' => 'required|unique:asatidlists,nama,' . $asatidlist->id,
            'ttl' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => 'NAMA sudah digunakan.',
            'ttl.required' => 'Kolom ttl wajib diisi.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            $staf->update(['foto' => $path]);
        }

        $asatidlist->update([
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'foto' => $path,
        ]);

        return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID berhasil diupdate');

    }


    public function destroy(Asatidlist $asatidlist)
    {
        $asatidlist->delete();
        return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID berhasil dihapus');
    }
}
