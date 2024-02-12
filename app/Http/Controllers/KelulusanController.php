<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\Mapel;
use App\Models\Santri;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Requests\StoreKelulusanRequest;
use App\Http\Requests\UpdateKelulusanRequest;
use App\Models\Klssantri;

class KelulusanController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $search = $request->input('search');
            $kelulusan = Kelulusan::where('santri_id', 'LIKE', "%$search%")->paginate(5);
        } else {
            $kelulusan = Kelulusan::paginate(5);

        }

        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $kelas = Klssantri::all();
        $santri = Santri::all();

        return view('kelulusan.kelulusan', compact('kelulusan', 'kelas', 'mapel', 'santri'));
    }

    public function create()
    {
        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $santri = Santri::all();

        return view('kelulusan.create', compact('kelulusan','mapel', 'santri'));
    }

    public function store(StoreKelulusanRequest $request)
    {
//
    }

    public function edit(Kelulusan $kelulusan)
    {
        $mapel = Mapel::all();
        $santri = Santri::all();

        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel', 'santri'));
    }

    public function update(UpdateKelulusanRequest $request, Kelulusan $kelulusan)
    {
        $request->validate([
            'no_ujian' => 'required',
            'nilai' => 'required',
        ], [
            'no_ujian.required' => 'Kolom NILAI wajib diisi',
            'nilai.required' => 'Kolom NILAI wajib diisi',
        ]);

        $nilaiMapel = $request->input('nilai');
        $no_ujian = $request->input('no_ujian');

        foreach ($nilaiMapel as $mapelId => $nilai) {
            $kelulusan->where('mapel_id', $mapelId)->update(['nilai' => $nilai]);
        }

        $kelulusan->no_ujian = $no_ujian;
        $kelulusan->save();

        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIUPDATE');
    }

    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();

        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIHAPUS');
    }
}
