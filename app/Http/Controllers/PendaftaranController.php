<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use App\Http\Requests\StorependaftaranRequest;
use App\Http\Requests\UpdatependaftaranRequest;

class PendaftaranController extends Controller
{

    public function index()
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }


    public function create()
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }


    public function store(StorependaftaranRequest $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|unique:pendaftarans,nama_lengkap',
            'jenis_kelamin' => 'required',
            'nik' => 'required|numeric|min:0|unique:pendaftarans,nik',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before:tomorrow',
            'alamat' => 'required',
            'nama_ortu' => 'required',
            'telepon_rumah' => 'required|numeric|min:0|unique:pendaftarans,telepon_rumah',
            'status' => 'required'
        ], [
            'nama_lengkap.required' => 'Kolom NAMA LENGKAP wajib diisi.',
            'nama_lengkap.unique' => 'NAMA LENGKAP sudah digunakan.',
            'jenis_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.min' => 'NIK tidak boleh MIN-',
            'nik.unique' => 'NIK sudah  digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'tanggal_lahir.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'tanggal_lahir.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'tanggal_lahir.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'nama_ortu.required' => 'Kolom NAMA ORTU wajib diisi.',
            'telepon_rumah.required' => 'Kolom TELEPON RUMAH wajib diisi.',
            'telepon_rumah.numeric' => 'TELEPON RUMAH  harus berupa angka',
            'telepon_rumah.min' => 'TELEPON RUMAH  tidak boleh MIN-',
            'telepon_rumah.unique' => 'TELEPON RUMAH sudah   digunakan.',
        ]);

        Pendaftaran::create([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nama_ortu' => $request->input('nama_ortu'),
            'telepon_rumah' => $request->input('telepon_rumah'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'PEDAFTARAN BERHASIL DITAMBAHKAN');
    }


    public function show(pendaftaran $pendaftaran)
    {
        //
    }


    public function edit(pendaftaran $pendaftaran)
    {
        $pendaftaran = Pendaftaran::all();
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }


    public function update(UpdatependaftaranRequest $request, pendaftaran $pendaftaran)
    {
        $request->validate([
            'nama_lengkap' => 'required|unique:pendaftarans,nama_lengkap,' . $pendaftaran->id,
            'jenis_kelamin' => 'required',
            'nik' => 'required|numeric|min:0|unique:pendaftarans,nik,' . $pendaftaran->id,
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before:tomorrow',
            'alamat' => 'required',
            'nama_ortu' => 'required',
            'telepon_rumah' => 'required|numeric|min:0|unique:pendaftarans,telepon_rumah,' . $pendaftaran->id,
            'status' => 'required',
        ], [
            'nama_lengkap.required' => 'Kolom NAMA LENGKAP wajib diisi.',
            'nama_lengkap.unique' => 'NAMA LENGKAP sudah digunakan.',
            'jenis_kelamin.required' => 'Kolom JENIS KELAMIN wajib diisi.',
            'nik.required' => 'Kolom NIK wajib diisi.',
            'nik.numeric' => 'NIK harus berupa angka',
            'nik.min' => 'NIK tidak boleh MIN-',
            'nik.unique' => 'NIK sudah  digunakan.',
            'status.required' => 'status tidak boleh kosong.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'tanggal_lahir.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'tanggal_lahir.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'tanggal_lahir.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'nama_ortu.required' => 'Kolom NAMA ORTU wajib diisi.',
            'telepon_rumah.required' => 'Kolom TELEPON RUMAH wajib diisi.',
            'telepon_rumah.numeric' => 'TELEPON RUMAH  harus berupa angka',
            'telepon_rumah.min' => 'TELEPON RUMAH  tidak boleh MIN-',
            'telepon_rumah.unique' => ' TELEPON RUMAH sudah digunakan.',
        ]);


        $pendaftaran->update([
            'nama_lengkap' => $request->input('nama_lengkap'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'nik' => $request->input('nik'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'nama_ortu' => $request->input('nama_ortu'),
            'telepon_rumah' => $request->input('telepon_rumah'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('pendaftaran.index')->with('success', 'PENDAFTARAN BERHASIL DIUPDATE');

    }


    public function destroy(pendaftaran $pendaftaran)
    {
        if ($pendaftaran->santri ()->exists()) {
            return redirect()->route('pendaftaran.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $pendaftaran->delete();
        return redirect()->route('pendaftaran.index')->with('success', 'PENDAFTARAN BERHASIL DIHAPUS');
    }
}
