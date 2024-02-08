<?php

namespace App\Http\Controllers;

use App\Models\Asatidlist;
use App\Models\User;
use Carbon\Carbon;
use Hash;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\StoreAsatidlistRequest;
use App\Http\Requests\UpdateAsatidlistRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class AsatidlistController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $casatidlist = $request->input('search');
            $asatidlist = Asatidlist::where('nama', 'LIKE', "%$casatidlist%")->paginate(5);
        } else {
            $asatidlist = Asatidlist::paginate(5);
        }
        return view('asatidlist.asatidlist', compact('asatidlist'));

    }


    public function create()
    {
        $asatidlist = Asatidlist::all();
        return view('asatidlist.asatidlist', compact('asatidlist'));

    }


    public function store(StoreAsatidlistRequest $request)
    {
        try {
            $request->validate([
                'nip' => 'required|numeric|min:0|unique:asatidlists,nip',
                'nama' => 'required|unique:users,nama',
                'email' => 'required|unique:users,email',
                'tempat_lahir' => 'required',
                'ttl' => 'required|date|before:tomorrow',
                'alamat' => 'required',
                'pendidikan' => 'required',
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ], [
                'nip.required' => 'Kolom NIP wajib diisi.',
                'nip.numeric' => 'NIP harus berupa angka',
                'nip.min' => 'NIP tidak boleh kurang dari 0',
                'nip.unique' => 'NIP sudah digunakan.',
                'nama.required' => 'Kolom NAMA wajib diisi.',
                'nama.unique' => 'NAMA sudah digunakan.',
                'email.required' => 'Kolom EMAIL wajib diisi.',
                'email.unique' => 'EMAIL sudah digunakan.',
                'tempat_lahir.required' => 'Kolom TEMPAT LAHIR wajib diisi.',
                'ttl.required' => 'Kolom TANGGAL LAHIR wajib diisi.',
                'ttl.date' => 'Kolom TANGGAL LAHIR harus berupa tanggal.',
                'ttl.before' => 'Kolom TANGGAL LAHIR tidak boleh lebih dari hari ini.',
                'alamat.required' => 'Kolom ALAMAT wajib diisi.',
                'pendidikan.required' => 'Kolom PENDIDIKAN wajib diisi.',
                'foto.required' => 'Kolom FOTO wajib diisi.',
                'foto.image' => 'Kolom FOTO harus berupa file gambar.',
                'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
                'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
            ]);

            $foto = $request->file('foto');
            $path = Storage::disk('public')->put('images', $foto);

            $asatidlist = Asatidlist::create([
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'ttl' => $request->input('ttl'),
                'alamat' => $request->input('alamat'),
                'pendidikan' => $request->input('pendidikan'),
                'foto' => $path,
            ]);

            User::create([
                'asatidlist_id' => $asatidlist->id,
                'email_verified_at' => now(),
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'password' => Hash::make('password'),
                'role' => 'asatid'
            ]);

            return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID BERHASIL DITAMBAHKAN');
        } catch (ValidationException $e) {
            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $th) {
            return back()->with('error', 'GAGAL MENAMBAHKAN ASATID. PESAN KESALAHAN: ' . $th->getMessage())->withInput();
        }

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
        try {
        $request->validate([
            'nip' => 'required|numeric|min:0|unique:asatidlists,nip,' . $asatidlist->id,
            'nama' => 'required|unique:users,nama,' . $asatidlist->id,
            'email' => 'required|unique:users,email,' . $asatidlist->id,
            'tempat_lahir' => 'required',
            'ttl' => 'required|date|before:tomorrow',
            'alamat' => 'required',
            'pendidikan' => 'required',
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
            'foto.required' => 'Kolom FOTO  wajib diisi.',
            'foto.image' => 'Kolom FOTO  harus berupa file gambar.',
            'foto.mimes' => 'Format gambar tidak valid. Gunakan format jpeg, png, jpg, atau gif.',
            'foto.max' => 'Ukuran gambar tidak boleh lebih dari 2 MB.',
        ]);

        // Cek apakah terdapat foto lama sebelum proses update
        if ($asatidlist->foto) {
            // Hapus foto lama dari folder penyimpanan
            Storage::disk('public')->delete($asatidlist->foto);

            // Hapus foto lama dari file sistem lokal (local file system)
            $localFilePath = public_path('storage/' . $asatidlist->foto);
            if (File::exists($localFilePath)) {
                File::delete($localFilePath);
            }
        }

    $data = [
        'nip' => $request->input('nip'),
        'nama' => $request->input('nama'),
        'email' => $request->input('email'),
        'tempat_lahir' => $request->input('tempat_lahir'),
        'ttl' => $request->input('ttl'),
        'alamat' => $request->input('alamat'),
        'pendidikan' => $request->input('pendidikan'),
    ];

    // Proses upload foto baru
    if ($request->hasFile('foto')) {
        $foto = $request->file('foto');
        $path = $foto->store('images', 'public');
        $data['foto'] = $path;
    }

    $asatidlist->update($data);
    $asatidlist = User::where('asatidlist_id', $asatidlist->id)->first();
    $asatidlist->nama = $request->input('nama');
    $asatidlist->email_verified_at = now();
    $asatidlist->email = $request->input('email');
    $asatidlist->save();

    return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID BERHASIL DITAMBAHKAN');
    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (Exception $th) {
        return back()->with('error', 'GAGAL MENAMBAHKAN ASATID. PESAN KESALAHAN: ' . $th->getMessage());
    }
}


    public function destroy(Asatidlist $asatidlist)
    {
        try {
            // Cek apakah terdapat data terkait di klssantri
            if ($asatidlist->klssantri()->exists()) {
                return redirect()->route('asatidlist.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
            }

            // Cek apakah foto ada sebelum dihapus
            if (Storage::disk('public')->exists($asatidlist->foto)) {
                // Hapus foto dari folder penyimpanan
                Storage::disk('public')->delete($asatidlist->foto);
            }

            // Cek apakah foto ada di file sistem lokal (local file system)
            $localFilePath = public_path('storage/' . $asatidlist->foto);
            if (File::exists($localFilePath)) {
                // Hapus foto dari file sistem lokal
                File::delete($localFilePath);
            }

            // Hapus record dari database
            $asatidlist->delete();

            return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID BERHASIL DIHAPUS');
        } catch (Exception $th) {
            return redirect()->route('asatidlist.index')->with('error', 'GAGAL MENGHAPUS ASATID. PESAN KESALAHAN: ' . $th->getMessage());
        }
    }
}
