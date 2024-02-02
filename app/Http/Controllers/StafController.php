<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafRequest;
use App\Models\staf;
use Carbon\Carbon;
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
    public function store(StafRequest $request)
    {
        $request->validate([
            'nip' => 'required|numeric|min:0|unique:stafs,nip',
            'nama' => 'required|unique:stafs,nama',
            'tempat_lahir' => 'required',
            'ttl' => 'required|date|before:tomorrow',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jabatan' => 'required',
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka',
            'nip.min' => 'NIP tidak boleh MIN-',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => 'NAMA sudah digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
            'jabatan.required' => 'Kolom JABATAN wajib diisi.',
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
            'tempat_lahir' => $request->input('tempat_lahir'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'jabatan' => $request->input('jabatan'),
            'foto' => $path,
        ]);

        return redirect()->route('staf.index')->with('success', 'STAF BERHASIL DITAMBAHKAN');

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
    public function update(StafRequest $request, staf $staf)
    {
        $request->validate([
            'nip' => 'required|numeric|min:0|unique:stafs,nip,' . $staf->id,
            'nama' => 'required|unique:stafs,nama,' . $staf->id,
            'tempat_lahir' => 'required',
            'ttl' => 'required|date|before:tomorrow',
            'alamat' => 'required',
            'pendidikan' => 'required',
            'jabatan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nip.required' => 'Kolom NIP wajib diisi.',
            'nip.numeric' => 'NIP harus berupa angka',
            'nip.min' => 'NIP tidak boleh MIN-',
            'nip.unique' => 'NIP sudah digunakan.',
            'nama.required' => 'Kolom NAMA wajib diisi.',
            'nama.unique' => 'NAMA sudah digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
            'jabatan.required' => 'Kolom JABATAN wajib diisi.',
            'foto.image' => 'Kolom FOTO harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);

        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'jabatan' => $request->input('jabatan'),
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            $data['foto'] = $path;

        }

        $staf->update($data);

        return redirect()->route('staf.index')->with('success', 'STAF BERHASIL DIUPDATE');
    }

   
    public function destroy(staf $staf)
    {
        $staf->delete();
        return redirect()->route('staf.index')->with('success', 'STAF BERHASIL DIHAPUS');
    }
}
