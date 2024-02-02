<?php

namespace App\Http\Controllers;

use App\Models\Asatid;
use App\Models\Asatidlist;
use App\Models\Berita;
use App\Models\Gallerie;
use App\Models\Kelulusan;
use App\Models\Klssantri;
use App\Models\santri;
use App\Models\staf;
use App\Models\Umum;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    public function index()
    {
        $jumlahStaf = staf::count();
        $jumlahSantri = santri::count();
        $jumlahAsatidlist = Asatidlist::count();
        $jumlahAsatid = Asatid::count();
        $jumlahKelas = Klssantri::count();

        $beritas = Berita::all();
        $galleris = Gallerie::all();
        $staf = staf::all();
<<<<<<< HEAD
        $asatid = asatid::all();
=======
        $asatidlist = Asatidlist::all();
>>>>>>> fc259cd7d164e35a2bca017119a214f918f627f4

        return view('layouts.template', [
            'jumlahStaf' => $jumlahStaf,
            'jumlahAsatid' => $jumlahAsatid ,
            'jumlahSantri' => $jumlahSantri,
            'jumlahKelas' => $jumlahKelas,
            'jumlahAsatidlist' => $jumlahAsatidlist,
            'beritas' => $beritas,
            'staf' => $staf,
            'asatidlist' => $asatidlist,
            'galleris' => $galleris,
            'staf' => $staf,
            'asatid' => $asatid,
        ]);

    }



    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }


    public function destroy(string $id)
    {
        //
    }
}
