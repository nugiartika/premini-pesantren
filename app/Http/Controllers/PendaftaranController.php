<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pendaftarans = pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftarans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendaftaran.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tempat_tinggal' => 'required',
            'nama_ortu' => 'required',
            'pendidikan_ortu' => 'required',
            'pekerjaan_ortu' => 'required',
            'sekolah_asal' => 'required',
            'telepon_rumah' => 'required',
        ]);

        pendaftaran::create($rules);
        return redirect()->route('pendaftaran.index')->with('success', 'Berhasil menambahkan data');
    }

    /**
     * Display the specified resource.
     */
    public function show(pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pendaftaran $pendaftaran)
    {
        return view('pendaftaran.edit', [
            'pendaftaran' => pendaftaran::find($pendaftaran)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, pendaftaran $pendaftaran)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'email' => 'required',
            'jenis_kelamin' => 'required',
            'nik' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'tempat_tinggal' => 'required',
            'tanggal_lahir' => 'required',
            'nama_ortu' => 'required',
            'pendidikan_ortu' => 'required',
            'pekerjaan_ortu' => 'required',
            'sekolah_asal' => 'required',
            'telepon_rumah' => 'required',
        ]);

        $pendaftaran = pendaftaran::find($pendaftaran);

        $pendaftaran->update($request->all());
        // return to_route('pendaftaran.index');
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(pendaftaran $pendaftaran)
    {
        pendaftaran::destroy($pendaftaran);
        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil dihapus');    }
}