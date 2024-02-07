<?php

namespace App\Http\Controllers;

use App\Models\Pendaftaran;
use Carbon\Carbon;
use App\Http\Requests\StorependaftaranRequest;
use App\Http\Requests\UpdatependaftaranRequest;
use App\Models\santri;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class PendaftaranController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $cpendaftaran = $request->input('search');
            $pendaftaran = Pendaftaran::where('nama_lengkap', 'LIKE', "%$cpendaftaran%")->paginate(5);
        } else {
            $pendaftaran = Pendaftaran::paginate(5);
        }
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }

    public function create()
    {
        return view('auth.register');
    }

    public function store(StorependaftaranRequest $request)
    {
        $request->validate([
            'nama' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'nisn' => 'required|numeric|min:0|unique:pendaftarans,nisn',
            'telepon' => 'required|numeric|min:0|unique:pendaftarans,telepon',
            'alamat' => 'required',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date|before:tomorrow',
            'status' => 'required'
        ],[
            'password.confirmed' => 'confirm password salah.',

        ]);

        $pendaftaran = Pendaftaran::create([
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'jenis_kelamin' => $request->input('jenis_kelamin'),
            'nisn' => $request->input('nisn'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'tanggal_lahir' => $request->input('tanggal_lahir'),
            'alamat' => $request->input('alamat'),
            'telepon' => $request->input('telepon'),
            'status' => 'menunggu konfirmasi',
        ]);

        return redirect()->route('register')->with('success_message', 'PENDAFTARAN BERHASIL DITAMBAHKAN');
    }

    public function edit(Pendaftaran $pendaftaran)
    {
        return view('pendaftaran.pendaftaran', compact('pendaftaran'));
    }

    public function update(UpdatependaftaranRequest $request, Pendaftaran $pendaftaran)
    {
        $request->validate([
            'status' => 'required',
        ]);

        $status = $request->input('status');

        if ($status === 'Diterima') {
            $santri = Santri::create([
                'nama' => $pendaftaran->nama,
                'email' => $pendaftaran->email,
                'nisn' => $pendaftaran->nisn,
                'telepon' => $pendaftaran->telepon,
                'alamat' => $pendaftaran->alamat,
                'jenis_kelamin' => $pendaftaran->jenis_kelamin,
                'tempat_lahir' => $pendaftaran->tempat_lahir,
                'tanggal_lahir' => $pendaftaran->tanggal_lahir,
            ]);
            User::create([
                'name' => $pendaftaran->nama,
                'email' => $pendaftaran->email,
                'password' => Hash::make($pendaftaran->password),
                'role' => 'santri',
                'pendaftaran_id' => $pendaftaran->id,
            ]);
        } elseif ($status === 'Ditolak') {
            if ($user = User::where('email', $pendaftaran->email)->first()) {
                $user->delete();
            }


            if ($santri = Santri::where('email', $pendaftaran->email)->first()) {
                $santri->delete();
            }

            // Hapus entri pendaftaran
            $pendaftaran->delete();

            return redirect()->route('pendaftaran.index')->with('success', 'PENDAFTARAN BERHASIL DIHAPUS');
        }
    }

}
