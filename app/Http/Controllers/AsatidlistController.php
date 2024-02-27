<?php

namespace App\Http\Controllers;

use App\Http\Requests\AsatidRequest;
use App\Models\Asatidlist;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\AsatidlistRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

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
        return view('asatidlist.create', compact('asatidlist'));
    }

 
    public function store(AsatidlistRequest $request)
    {
        try {
            $data = [
                'nip' => $request->input('nip'),
                'nama' => $request->input('nama'),
                'email' => $request->input('email'),
                'tempat_lahir' => $request->input('tempat_lahir'),
                'ttl' => $request->input('ttl'),
                'alamat' => $request->input('alamat'),
                'pendidikan' => $request->input('pendidikan'),
                'foto' => $request->input('foto'),
            ];

            if ($request->hasFile('foto')) {
                $foto = $request->file('foto');
                $path = $foto->store('images', 'public');
                $data['foto'] = $path;
            } else {
                $defaultImagePath = 'images/default-photo.jpg';
                $data['foto'] = $defaultImagePath;
            }

            $asatidlist = Asatidlist::create($data);

            User::create([
                'asatidlist_id' => $asatidlist->id,
                'email_verified_at' => now(),
                'name' => $request->input('nama'),
                'email' => $request->input('email'),
                'password' => Hash::make('password'),
                'role' => 'asatid',
            ]);

            return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID BERHASIL DITAMBAHKAN');
        } catch (ValidationException $e) {
            $request->flash();

            return back()->withErrors($e->errors())->withInput();
        } catch (Exception $th) {
            return back()->with('error', 'GAGAL MENAMBAHKAN ASATID. PESAN KESALAHAN: ' . $th->getMessage())->withInput();
        }
    }


    public function show(Asatidlist $asatidlist)
    {
    }

    public function edit($id)
    {
        $asatidlist = AsatidList::find($id);
        return view('asatidlist.edit', compact('asatidlist'));
    }

    public function update(AsatidlistRequest $request, $id)
    {
        try {
        $asatidlist = AsatidList::findOrFail($id);

        $oldPhotoPath = $asatidlist->foto;

        $data = [
            'nip' => $request->input('nip'),
            'nama' => $request->input('nama'),
            'email' => $request->input('email'),
            'tempat_lahir' => $request->input('tempat_lahir'),
            'ttl' => $request->input('ttl'),
            'alamat' => $request->input('alamat'),
            'pendidikan' => $request->input('pendidikan'),
        ];

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $path = $foto->store('images', 'public');
            $data['foto'] = $path;
        } elseif ($asatidlist->foto) {
            $data['foto'] = $asatidlist->foto;
        }

        $asatidlist->update($data);
        $user = $asatidlist->user;
        $user->name = $request->input('nama');
        $user->email_verified_at = now();
        $user->email = $request->input('email');
        $user->save();

        if ($asatidlist->wasChanged('foto') && $oldPhotoPath) {
            Storage::disk('public')->delete($oldPhotoPath);
            $localFilePath = public_path('storage/' . $oldPhotoPath);
            if (File::exists($localFilePath)) {
                File::delete($localFilePath);
            }
        }

        return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID BERHASIL DIUPDATE');
    } catch (ValidationException $e) {
        return back()->withErrors($e->errors())->withInput();
    } catch (Exception $th) {
        return back()->with('error', 'GAGAL UPDATE ASATID. PESAN KESALAHAN: ' . $th->getMessage());
    }
}


    public function destroy(Asatidlist $asatidlist)
    {
        try {
            if ($asatidlist->klssantri()->exists()) {
                return redirect()->route('asatidlist.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
            }

            if (Storage::disk('public')->exists($asatidlist->foto)) {
                Storage::disk('public')->delete($asatidlist->foto);
            }

            $asatidlist->delete();
  
            return redirect()->route('asatidlist.index')->with('success', 'LIST ASATID BERHASIL DIHAPUS');
        } catch (Exception $th) {
            return redirect()->route('asatidlist.index')->with('error', 'GAGAL MENGHAPUS ASATID. PESAN KESALAHAN: ' . $th->getMessage());
        }
    }
}
