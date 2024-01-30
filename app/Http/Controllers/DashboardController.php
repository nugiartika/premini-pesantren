<?php

namespace App\Http\Controllers;

use App\Models\Asatid;
use App\Models\Berita;
use App\Models\Gallerie;
use App\Models\Kelulusan;
use App\Models\Klssantri;
use App\Models\santri;
use App\Models\staf;
use App\Models\Umum;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $jumlahStaf = staf::count();
        $jumlahSantri = santri::count();
        $jumlahAsatid = Asatid::count();
        $jumlahKelas = Klssantri::count();
        $jumlahGallery = Gallerie::count();
        $jumlahBerita = Berita::count();
        $jumlahKelulusan = Kelulusan::count();
        $jumlahPengumuman = Umum::count();

        return view('dashboard.dashboard', [
            'jumlahStaf' => $jumlahStaf,
            'jumlahGallery' => $jumlahGallery,
            'jumlahAsatid' => $jumlahAsatid ,
            'jumlahSantri' => $jumlahSantri,
            'jumlahKelas' => $jumlahKelas,
            'jumlahBerita' => $jumlahBerita,
            'jumlahKelulusan' => $jumlahKelulusan,
            'jumlahPengumuman' => $jumlahPengumuman,
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
