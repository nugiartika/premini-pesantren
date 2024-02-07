<?php

namespace App\Http\Controllers;

use App\Http\Requests\StafRequest;
use App\Models\Staf;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;



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

    /**
     * Store a newly created resource in storage.
     */
    public function store(StafRequest $request)
    {
        try {
        $request->validate([
            'nip' => 'required|numeric|min:0|unique:stafs,nip',
            'nama' => 'required|unique:stafs,nama',
            'nama' => 'required|unique:users,nama',
            'nama' => 'required|unique:asatidlists,nama',
            'email' => 'required|unique:asatidlists,email',
            'email' => 'required|unique:stafs,email',
            'email' => 'required|unique:users,email',
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
            'email.required' => 'Kolom EMAIL wajib diisi.',
            'email.unique' => 'EMAIL sudah digunakan.',
            'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
            'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
            'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
            'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
            'alamat.required' => 'Kolom ALAMAT wajib diisi.',
            'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
            'jabatan.required' => 'Kolom JABATAN wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);
        $foto = $request->file('foto');
        $path = Storage::disk('public')->put('images', $foto);

        $staf = Staf::create([
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
            'jabatan' => $request->input('jabatan'),
            'foto' => $path,
        ]);
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
    public function update(StafRequest $request, Staf $staf, User $user)
    {
        try {
            $request->validate([
                'nip' => 'required|numeric|min:0|unique:stafs,nip,' . $staf->id,
                'nama' => 'required|unique:stafs,nama,' . $staf->id,
                'nama' => 'required|unique:users,nama,' . $staf->id,
                'nama' => 'required|unique:asatidlists,nama,' . $staf->id,
                'email' => 'required|unique:asatidlists,email,' . $staf->id,
                'email' => 'required|unique:stafs,email,' . $staf->id,
                'email' => 'required|unique:users,email,' . $staf->id,
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
                'email.required' => 'Kolom EMAIL wajib diisi.',
                'email.unique' => 'EMAIL sudah digunakan.',
                'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
                'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
                'ttl.date' => 'Kolom TANGGAL LAHIR  harus berupa tanggal.',
                'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
                'alamat.required' => 'Kolom ALAMAT wajib diisi.',
                'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
                'jabatan.required' => 'Kolom JABATAN wajib diisi.',
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
                $path = $foto->store('images', 'public');
                $data['foto'] = $path;
            }

        $staf->update($data);

        $staf->updateUsers([
            'name' => $request->input('nama'),
            'email' => $request->input('email'),
        ]);
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
