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

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jumlahStaf = staf::count();
        $jumlahSantri = santri::count();
        $jumlahAsatid = Asatid::count();
        $jumlahKelas = Klssantri::count();

        $beritas = Berita::all();
        $galleris = Gallerie::all();
        $staf = staf::all();

        return view('layouts.template', [
            'jumlahStaf' => $jumlahStaf,
            'jumlahAsatid' => $jumlahAsatid ,
            'jumlahSantri' => $jumlahSantri,
            'jumlahKelas' => $jumlahKelas,
            'beritas' => $beritas,
            'galleris' => $galleris,
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
