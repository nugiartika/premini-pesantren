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


            return redirect()->back()->with('error', 'Gagal menambahkan data. Pesan kesalahan: ' . $e->getMessage());
        }
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

    }


    public function destroy(Kelulusan $kelulusan)
    {
        $kelulusan->delete();
        return redirect()->route('kelulusan.index')->with('success', 'PENGUMUMAN KELULUSAN BERHASIL DIHAPUS');
    }
}
