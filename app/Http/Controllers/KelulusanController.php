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
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }


    public function store(StoreKelulusanRequest $request)
    {
        try {
            $request->validate([
                'santri_id' => 'required',
                'no_ujian' => 'required|numeric|min:0|unique:kelulusans,no_ujian',
                'mapel_id' => 'required',
                'nilai' => 'required|string',
            ]);

            $grades = $request->input('nilai');
            $santriId = $request->input('santri_id');

            // Retrieve existing records for the same student
            $existingRecords = Kelulusan::where('santri_id', $santriId)->get();

            // Combine existing grades with new grades
            $allGrades = $existingRecords->pluck('nilai')->merge($grades)->map(function ($grade) {
                return (int)$grade;
            });

            // Calculate the average
            $average = $allGrades->isNotEmpty() ? $allGrades->avg() : 0;

            $keterangan = ($average >= 80) ? 'Lulus' : 'Tidak Lulus';


            Kelulusan::create([
                'santri_id' => $request->input('santri_id'),
                'no_ujian' => $request->input('no_ujian'),
                'mapel_id' => $request->input('mapel_id'),
                'nilai' => json_encode($grades),
                'keterangan' => $keterangan,
            ]);

            return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DITAMBAHKAN');
        } catch (\Exception $e) {
            info('Error in KelulusanController@store: ' . $e->getMessage());

            // Tampilkan pesan error

            return redirect()->back()->with('error', 'Gagal menambahkan data. Pesan kesalahan: ' . $e->getMessage());
        }
    }


    public function show(Kelulusan $kelulusan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kelulusan $kelulusan)
    {
        $kelulusan = Kelulusan::all();
        $mapel = Mapel::all();
        $santri = Santri::all();
        return view('kelulusan.kelulusan', compact('kelulusan', 'mapel','santri'));
    }


    public function update(UpdateKelulusanRequest $request, Kelulusan $kelulusan)
    {
        // $request->validate([
        //     'santri_id' => 'required|unique:kelulusans,santri_id,' . $kelulusan->id,
        //     'no_ujian' => 'required|numeric|min:0|unique:kelulusans,no_ujian,' . $kelulusan->id,
        //     'mapel_id' => 'required',
        //     'nilai' => 'required|numeric|min:0|max:100',
        // ], [
        //     'santri_id.required' => 'Kolom NAMA SANTRI wajib diisi.',
        //     'santri_id.unique' => 'NAMA SANTRI sudah digunakan.',
        //     'no_ujian.required' => 'Kolom NON UJIAN wajib diisi.',
        //     'no_ujian.numeric' => 'NO UJIAN harus berupa angka',
        //     'no_ujian.min' => 'NO UJIAN tidak boleh MIN-',
        //     'no_ujian.unique' => 'NO UJIAN sudah digunakan.',
        //     'mapel_id.required' => 'Kolom MAPEL wajib diisi.',
        //     'nilai.required' => 'Kolom NILAI wajib diisi.',
        //     'nilai.numeric' => ' NILAI harus berupa angka',
        //     'nilai.min' => ' NILAI tidak boleh MIN-',
        //     'nilai.max' => ' NILAI max 100',
        // ]);

        // $nilai = $request->input('nilai');
        // $keterangan = ($nilai >= 80) ? 'Lulus' : 'Tidak Lulus';

        // $kelulusan->update([
        //     'santri_id' => $request->input('santri_id'),
        //     'no_ujian' => $request->input('no_ujian'),
        //     'mapel_id' => $request->input('mapel_id'),
        //     'nilai' => $nilai,
        //     'keterangan' => $keterangan,
        // ]);
        // return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIUPDATE');

    }


    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIHAPUS');
    }
}
