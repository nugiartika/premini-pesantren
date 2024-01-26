<?php

namespace App\Http\Controllers;

use App\Models\pendaftaran;
use App\Http\Requests\StorependaftaranRequest;
use App\Http\Requests\UpdatependaftaranRequest;

class PendaftaranController extends Controller
{

    public function index()
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorependaftaranRequest $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|unique:pendaftaran,nama_lengkap',
            'email' => 'required|unique:pendaftaran,email',
            'jns_kelamin' => 'required',
            'nik' => 'required|unique:pendaftaran,nik',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tempat_tinggal' => 'required',
            'nama_ortu' => 'required',
            'pendidikan_ortu' => 'required',
            'pekerjaan_ortu' => 'required',
            'sekolah_asal' => 'required',
            'telepon_rumah' => 'required',
        ], [
            'nama_lengkap.required' => 'Kolom NAMA LENGKAP wajib diisi.',
            'nama_lengkap.unique' => ' sudah NAMA LENGKAPdigunakan.',
            'email.required' => 'Kolom EMAIL wajib diisi.',
            'email.unique' => ' sudah EMAIL digunakan.',
            'jns_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'nik.unique' => ' sudah NIK digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'tanggal_lahir.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'tempat_tinggal.required' => 'Kolom TEMPAT TINGGAL wajib diisi.',
            'nama_ortu.required' => 'Kolom NAMA ORTU wajib diisi.',
            'pendidikan_ortu.required' => 'Kolom PENDIDIKAN ORTU wajib diisi.',
            'pekerjaan_ortu.required' => 'Kolom PEKERJAAN ORTU wajib diisi.',
            'sekolah_asal.required' => 'Kolom SEKOLAH ASAL wajib diisi.',
            'telepon_rumah.required' => 'Kolom TELEPON RUJMAH wajib diisi.',
        ]);

        pendaftaran::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'jns_kelamin' => $request->input('jns_kelamin'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'tempat_tinggal' => $request->input('tempat_tinggal'),
            'nama_ortu' => $request->input('nama_ortu'),
            'pendidikan_ortu' => $request->input('pendidikan_ortu'),
            'pekerjaan_ortu' => $request->input('pekerjaan_ortu'),
            'sekolah_asal' => $request->input('sekolah_asal'),
            'telepon_rumah' => $request->input('telepon_rumah'),
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'PEDAFTARAN berhasil ditambahkan');
    }


    public function show(pendaftaran $pendaftaran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(pendaftaran $pendaftaran)
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatependaftaranRequest $request, pendaftaran $pendaftaran)
    {
        $request->validate([
            'nama_lengkap' => 'required|unique:pendaftaran,nama_lengkap,' . $pendaftaran->id,
            'email' => 'required|unique:pendaftaran,email,' . $pendaftaran->id,
            'jns_kelamin' => 'required',
            'nik' => 'required|unique:pendaftaran,nik,' . $pendaftaran->id,
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required',
            'alamat' => 'required',
            'tempat_tinggal' => 'required',
            'nama_ortu' => 'required',
            'pendidikan_ortu' => 'required',
            'pekerjaan_ortu' => 'required',
            'sekolah_asal' => 'required',
            'telepon_rumah' => 'required',
        ], [
            'nama_lengkap.required' => 'Kolom NAMA LENGKAP wajib diisi.',
            'nama_lengkap.unique' => ' sudah NAMA LENGKAPdigunakan.',
            'email.required' => 'Kolom EMAIL wajib diisi.',
            'email.unique' => ' sudah EMAIL digunakan.',
            'jns_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'nik.unique' => ' sudah NIK digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'tanggal_lahir.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'tempat_tinggal.required' => 'Kolom TEMPAT TINGGAL wajib diisi.',
            'nama_ortu.required' => 'Kolom NAMA ORTU wajib diisi.',
            'pendidikan_ortu.required' => 'Kolom PENDIDIKAN ORTU wajib diisi.',
            'pekerjaan_ortu.required' => 'Kolom PEKERJAAN ORTU wajib diisi.',
            'sekolah_asal.required' => 'Kolom SEKOLAH ASAL wajib diisi.',
            'telepon_rumah.required' => 'Kolom TELEPON RUJMAH wajib diisi.',
        ]);


        $pendaftaran->update([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'jns_kelamin' => $request->input('jns_kelamin'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'tempat_tinggal' => $request->input('tempat_tinggal'),
            'nama_ortu' => $request->input('nama_ortu'),
            'pendidikan_ortu' => $request->input('pendidikan_ortu'),
            'pekerjaan_ortu' => $request->input('pekerjaan_ortu'),
            'sekolah_asal' => $request->input('sekolah_asal'),
            'telepon_rumah' => $request->input('telepon_rumah'),
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'PENDAFTARAN berhasil diupdate');

    }


    public function destroy(pendaftaran $pendaftaran)
    {
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'PENDAFTARAN berhasil dihapus');
    }
}
