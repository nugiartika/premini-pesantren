<?php

namespace App\Http\Controllers;

use App\Models\santri;
use App\Models\klssantri;
use App\Models\pendaftaran;
use Carbon\Carbon;
use App\Http\Requests\StoresantriRequest;
use App\Http\Requests\UpdatesantriRequest;
use Illuminate\Http\Request;



class SantriController extends Controller
{

    public function index(Request $request)
    {
        if ($request->has('search')) {
            $csantri = $request->input('search');
            $santri = Santri::where('pendaftaran_id', 'LIKE', "%$csantri%")->paginate(5);
        } else {
            $santri = Santri::paginate(5);
        }
        $klssantri = klssantri::all();
        $pendaftaran = pendaftaran::all();
        return view('santri.santri', compact('santri', 'klssantri', 'pendaftaran'));
    }


    public function create()
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        $pendaftaran = pendaftaran::all();
        return view('santri.santri', compact('santri', 'klssantri', 'pendaftaran'));
    }


    public function store(StoresantriRequest $request)
    {
        $request->validate([
            'klssantri_id' => 'nullable',
        ]);
        Santri::create([
            'klssantri_id' => $request->input('klssantri_id'),
        ]);
        

        return redirect()->route('santri.index')->with('success', 'SANTRI BERHASIL DITAMBAHKAN');

    }


    public function show(santri $santri)
    {
        //
    }


    public function edit(santri $santri)
    {
        $santri = santri::all();
        $klssantri = klssantri::all();
        $pendaftaran = pendaftaran::all();
        return view('santri.santri', compact('santri', 'klssantri', 'pendaftaran'));
    }


    public function update(UpdatesantriRequest $request, santri $santri)
    {
        $request->validate([
            'klssantri_id' => 'required',
        ], [
            'klssantri_id.required' => 'Kolom KELAS wajib diisi',

        ]);
        $santri->update([
            'klssantri_id' => $request->input('klssantri_id'),
        ]);

        return redirect()->route('santri.index')->with('success', 'SANTRI BERHASIL DIUPDATE');

    }


    public function destroy(santri $santri)
    {
        if ($santri->kelulusan ()->exists()|| $santri->syahriah()->exists()) {
            return redirect()->route('santri.index')->with('warning', 'TIDAK DAPAT DIHAPUS KARENA MASIH TERDAPAT DATA TERKAIT.');
        }
        $santri->delete();
        return redirect()->route('santri.index')->with('success', 'SANTRI BERHASIL DIHAPUS');
    }
}
