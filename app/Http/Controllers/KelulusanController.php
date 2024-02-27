<?php

namespace App\Http\Controllers;

use App\Models\Kelulusan;
use App\Models\mapel;
use App\Models\santri;
use App\Http\Requests\KelulusanRequest;
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

    public function store(KelulusanRequest $request)
    {
        $santriId = $request->input('santri_id');
        $noUjian = $request->input('no_ujian');

        $isDuplicateNoUjian = Kelulusan::where('no_ujian', $noUjian)
                    ->where('santri_id', '!=', $santriId)
                    ->exists();

            if ($isDuplicateNoUjian) {
                return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['no_ujian' => 'Nomor ujian ini sudah digunakan oleh santri lain.']);
            }

            $isDuplicateNameDifferentNoUjian = Kelulusan::whereHas('santri', function ($query) use ($santriId, $noUjian) {
                                        $query->where('id', $santriId)
                                              ->where('no_ujian', '!=', $noUjian);
                                    })
                                    ->exists();

                                    if ($isDuplicateNameDifferentNoUjian) {
                                        return redirect()->back()
                                            ->withInput($request->all())
                                            ->withErrors(['no_ujian' => 'Santri ini sudah memiliki NoUjian.']);
                                    }
        $mapelId = $request->input('mapel_id');

        $isDuplicateMapel = Kelulusan::where('santri_id', $santriId)
                                      ->where('mapel_id', $mapelId)
                                      ->exists();

        if ($isDuplicateMapel) {
            return redirect()->back()
            ->withInput($request->all())
            ->withErrors(['mapel_id' => 'Santri tersebut sudah memiliki kelulusan untuk mapel ini.']);

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


    public function update(KelulusanRequest $request, Kelulusan $kelulusan)
    {
        $santriId = $request->input('santri_id');
        $noUjian = $request->input('no_ujian');

        $noujian = Kelulusan::where('no_ujian', $noUjian)
            ->where('santri_id', '!=', $santriId)
            ->where('id', '!=', $kelulusan->id)
            ->exists();

        $namasamanoujian = Kelulusan::whereHas('santri', function ($query) use ($santriId, $noUjian) {
            $query->where('santri_id', $santriId)
                ->where('no_ujian', '!=', $noUjian);
        })->where('id', '!=', $kelulusan->id)->exists();

        if ($noujian && !$namasamanoujian) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['no_ujian' => 'Nomor ujian ini sudah digunakan oleh santri lain.']);
        }

        $mapelId = $request->input('mapel_id');

        $DuplicateMapel = Kelulusan::where('santri_id', $santriId)
            ->where('mapel_id', $mapelId)
            ->where('id', '!=', $kelulusan->id)
            ->exists();

        if ($DuplicateMapel) {
            return redirect()->back()
                ->withInput($request->all())
                ->withErrors(['mapel_id' => 'Santri tersebut sudah memiliki kelulusan untuk mapel ini.']);
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
