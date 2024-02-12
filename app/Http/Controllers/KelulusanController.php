<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\mapel;
use App\Models\santri;
use App\Http\Requests\StoreKelulusanRequest;
use App\Http\Requests\UpdateKelulusanRequest;
use Illuminate\Http\Request;


class KelulusanController extends Controller
{

    public function index(Request $request)
    {
        $kelulusan = Kelulusan::all();
        if ($request->has('search')) {
            $ckelulusan = $request->input('search');
            $kelulusan = Kelulusan::where('santri_id', 'LIKE', "%$ckelulusan%")->paginate(5);
        } else {
            $kelulusan = Kelulusan::paginate(5);
        }
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }

    public function create()
    {
        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }

    public function store(StoreKelulusanRequest $request)
    {
        $request->validate([
            'santri_id' => 'required',
            'no_ujian' => 'required|numeric|min:0',
            'mapel_id' => 'required',
            'nilai' => 'required|numeric|min:0|max:100',
        ], [
            'santri_id.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'no_ujian.required' => 'Kolom NO UJIAN wajib diisi.',
            'no_ujian.numeric' => 'NO UJIAN harus berupa angka',
            'no_ujian.min' => 'NO UJIAN tidak boleh MIN-',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'nilai.required' => 'Kolom NILAI wajib diisi.',
            'nilai.numeric' => ' NILAI harus berupa angka',
            'nilai.min' => ' NILAI tidak boleh MIN-',
            'nilai.max' => ' NILAI max 100',
        ]);

        $santriId = $request->input('santri_id');
        $noUjian = $request->input('no_ujian');


        $isDuplicateNoUjian = Kelulusan::where('no_ujian', $noUjian)
                                ->where('santri_id', '!=', $santriId)
                                ->exists();

if ($isDuplicateNoUjian) {
    return redirect()->back()->withErrors(['no_ujian' => 'Nomor ujian ini sudah digunakan oleh santri lain.']);
}
        // Periksa apakah ada santri dengan nama yang sama tetapi nomor ujian berbeda
        $isDuplicateNameDifferentNoUjian = Kelulusan::whereHas('santri', function ($query) use ($santriId, $noUjian) {
                                        $query->where('id', $santriId)
                                              ->where('no_ujian', '!=', $noUjian);
                                    })
                                    ->exists();

        if ($isDuplicateNameDifferentNoUjian) {
            return redirect()->back()->withErrors(['no_ujian' => 'Santri ini sudah memiliki nomor ujian.']);
        }
        $mapelId = $request->input('mapel_id');

        // Periksa apakah mapel yang sama sudah ada untuk santri tersebut
        $isDuplicateMapel = Kelulusan::where('santri_id', $santriId)
                                      ->where('mapel_id', $mapelId)
                                      ->exists();

        if ($isDuplicateMapel) {
            return redirect()->back()->withErrors(['mapel_id' => 'Santri tersebut sudah memiliki kelulusan untuk mapel ini.']);
        }


        $nilai = $request->input('nilai');
        $keterangan = ($nilai >= 80) ? 'Lulus' : 'Tidak Lulus';

        Kelulusan::create([
            'santri_id' => $request->input('santri_id'),
            'no_ujian' => $request->input('no_ujian'),
            'mapel_id' => $request->input('mapel_id'),
            'nilai' => $nilai,
            'keterangan' => $keterangan,
         ]);

        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DITAMBAHKAN');

    }


    public function show(Kelulusan $kelulusan)
    {
        //
    }


    public function edit(Kelulusan $kelulusan)
    {
        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }


    public function update(UpdateKelulusanRequest $request, Kelulusan $kelulusan)
    {
        $request->validate([
            'santri_id' => 'required',
            'no_ujian' => 'required|numeric|min:0',
            'mapel_id' => 'required',
            'nilai' => 'required|numeric|min:0|max:100',
        ], [
            'santri_id.required' => 'Kolom NAMA SANTRI wajib diisi.',
            'no_ujian.required' => 'Kolom NON UJIAN wajib diisi.',
            'no_ujian.numeric' => 'NO UJIAN harus berupa angka',
            'no_ujian.min' => 'NO UJIAN tidak boleh MIN-',
            'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
            'nilai.required' => 'Kolom NILAI wajib diisi.',
            'nilai.numeric' => ' NILAI harus berupa angka',
            'nilai.min' => ' NILAI tidak boleh MIN-',
            'nilai.max' => ' NILAI max 100',
        ]);

        $santriId = $request->input('santri_id');
        $noUjian = $request->input('no_ujian');

        $isDuplicateNoUjian = Kelulusan::where('no_ujian', $noUjian)
                                ->where('santri_id', '!=', $santriId)
                                ->exists();

        if ($isDuplicateNoUjian) {
            return redirect()->back()->withErrors(['no_ujian' => 'Nomor ujian ini sudah digunakan oleh santri lain.']);
        }
        // Periksa apakah ada santri dengan nama yang sama tetapi nomor ujian berbeda
        $isDuplicateNameDifferentNoUjian = Kelulusan::whereHas('santri', function ($query) use ($santriId, $noUjian) {
                                        $query->where('santri_id', $santriId)
                                              ->where('no_ujian', '!=', $noUjian);
                                    })
                                    ->exists();

        if ($isDuplicateNameDifferentNoUjian) {
            return redirect()->back()->withErrors(['no_ujian' => 'Santri ini sudah memiliki nomor ujian.']);
        }

        $mapelId = $request->input('mapel_id');

        // Periksa apakah mapel yang sama sudah ada untuk santri tersebut
        $isDuplicateMapel = Kelulusan::where('santri_id', $santriId)
                                      ->where('mapel_id', $mapelId)
                                      ->exists();

        if ($isDuplicateMapel) {
            return redirect()->back()->withErrors(['mapel_id' => 'Santri tersebut sudah memiliki kelulusan untuk mapel ini.']);
        }


        $nilai = $request->input('nilai');
        $keterangan = ($nilai >= 80) ? 'Lulus' : 'Tidak Lulus';

        $kelulusan->update([
            'santri_id' => $request->input('santri_id'),
            'no_ujian' => $request->input('no_ujian'),
            'mapel_id' => $request->input('mapel_id'),
            'nilai' => $nilai,
            'keterangan' => $keterangan,
        ]);
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIUPDATE');
    }


    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIHAPUS');
    }
}
