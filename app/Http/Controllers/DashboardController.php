<?php

namespace App\Http\Controllers;

use App\Models\Asatidlist;
use App\Models\santri;
use App\Models\Klssantri;
use App\Models\Gallerie;
use App\Models\Berita;
use App\Models\Kelulusan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{

    public function index()
    {
        $jumlahAsatidlist = Asatidlist::count();
        $jumlahSantri = santri::count();
        $jumlahKelas = Klssantri::count();
        $jumlahGallery = Gallerie::count();
        $jumlahBerita = Berita::count();
        $jumlahKelulusan = Kelulusan::count();

        return view('dashboard.dashboard', [
            'jumlahAsatidlist' => $jumlahAsatidlist ,
            'jumlahSantri' => $jumlahSantri,
            'jumlahKelas' => $jumlahKelas,
            'jumlahGallery' => $jumlahGallery,
            'jumlahBerita' => $jumlahBerita,
            'jumlahKelulusan' => $jumlahKelulusan,
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
