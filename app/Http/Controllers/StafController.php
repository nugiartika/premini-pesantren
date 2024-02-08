<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafRequest;
use App\Models\Staf;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class StafController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $cstaf = $request->input('search');
            $staf = Staf::where('nama', 'LIKE', "%$cstaf%")->paginate(5);
        } else {
            $staf = Staf::paginate(5);
        }
        return view('staf.staf', compact('staf'));

    }


    public function create()
    {
        $staf = Staf::all();
        return view('staf.staf', compact('staf'));

    }


    public function store(StafRequest $request, Staf $staf)
    {
        try {
        $request->validate([
            'nip' => 'required|numeric|min:0|unique:stafs,nip',
            'nama' => 'required|unique:users,nama',
            'email' => 'required|unique:users,email',
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
            'email.required' => 'Kolom EMAIL wajib diisi.',
            'email.unique' => 'EMAIL sudah digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
            'jabatan.required' => 'Kolom JABATAN wajib diisi.',
            'foto.required' => 'Kolom FOTO wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);


        $data = $request->validated();

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $filename = Str::random(20) . '.' . $foto->getClientOriginalExtension();
            $data['foto'] = $foto->storeAs($filename, 'public');

            if ($staf->foto) {
                Storage::disk('public')->delete($staf->foto);
            }
        }

        $staf = Staf::create($data);

        User::create([
            'staf_id' => $staf->id,
            'email_verified_at' => now(),
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
            'password' => Hash::make('password'),
            'role' => 'staf'
        ]);


        return redirect()->route('staf.index')->with('success', 'LIST ASATID BERHASIL DITAMBAHKAN');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $th) {
        return back()->with('error', 'GAGAL MENAMBAHKAN ASATID. PESAN KESALAHAN: ' . $th->getMessage());
    }
    }


    public function show(staf $staf)
    {
        //
    }


    public function edit(staf $staf)
    {
        $staf = Staf::all();
        return view('staf.staf', compact('staf'));
    }


    public function update(StafRequest $request, Staf $staf, User $user)
    {
        try {
            $request->validate([
                'nip' => 'required|numeric|min:0|unique:stafs,nip,' . $staf->id,
                'nama' => 'required|unique:users,nama,' . $staf->id,
                'email' => 'required|unique:users,email,' . $staf->id,
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
                'email.required' => 'Kolom EMAIL wajib diisi.',
                'email.unique' => 'EMAIL sudah digunakan.',
                'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
                'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
                'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
                'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
                'alamat.required' => 'Kolom ALAMAT wajib diisi.',
                'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
                'jabatan.required' => 'Kolom JABATAN wajib diisi.',
                'foto.required' => 'Kolom FOTO wajib diisi.',
                'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
                'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
                'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            ]);

            $data = [
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'ttl' => $request->input('ttl'),
                'alamat' => $request->input('alamat'),
                'pendidikan' => $request->input('pendidikan'),
                'jabatan' => $request->input('jabatan'),
            ];

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $data['foto'] = Str::random(20) . '.' . $foto->getClientOriginalExtension();
                Storage::disk('public')->put($data['foto'], file_get_contents($foto));
                Storage::disk('public')->delete($staf->foto);
            } else {
                $data['foto'] = $staf->foto;
            }




            $staf->update($data);
            $staf = User::where('staf_id', $staf->id)->first();
            $staf->name = $request->input('nama');
            $staf->email_verified_at = now();
            $staf->email = $request->input('email');
            $staf->save();

    return redirect()->route('staf.index')->with('success', 'LIST ASATID BERHASIL DITAMBAHKAN');
    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (Exception $th) {
        return back()->with('error', 'GAGAL MENAMBAHKAN ASATID. PESAN KESALAHAN: ' . $th->getMessage());
    }
    }

    public function destroy(staf $staf)
    {
        $staf->delete();
        return redirect()->route('staf.index')->with('success', 'STAF BERHASIL DIHAPUS');
    }
}
