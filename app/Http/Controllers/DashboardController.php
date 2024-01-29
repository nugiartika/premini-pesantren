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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahStaf = staf::count(); // Menghitung jumlah data staf
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
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
