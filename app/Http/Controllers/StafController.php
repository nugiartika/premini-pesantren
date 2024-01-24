<?php

namespace App\Http\Controllers;

use App\Models\staf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StafController extends Controller
{

    public function index()
    {
        $staf = Staf::all();
        return view('staf.staf', compact('staf'));

    }


    public function create()
    {
        $staf = Staf::all();
        return view('staf.staf', compact('staf'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nip' => 'required|unique:stafs,nip',
            'nama' => 'required|unique:stafs,nama',
            'ttl' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jabatan' => 'required',
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

        Staf::create([
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'jabatan' => $request->input('jabatan'),
            'foto' => $path,
        ]);

        return redirect()->route('staf.index')->with('success', 'STAF berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(staf $staf)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(staf $staf)
    {
        $staf = Staf::all();
        return view('staf.staf', compact('staf'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, staf $staf)
    {
        $request->validate([
            'nip' => 'required|unique:stafs,nip,' . $staf->id,
            'nama' => 'required|unique:stafs,nama,' . $staf->id,
            'ttl' => 'required',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jabatan' => 'required',
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

        $staf->update([
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'jabatan' => $request->input('jabatan'),
            'foto' => $path,
        ]);

        return redirect()->route('staf.index')->with('success', 'STAF berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(staf $staf)
    {
        $staf->delete();
        return redirect()->route('staf.index')->with('success', 'STAF berhasil dihapus');
    }
}