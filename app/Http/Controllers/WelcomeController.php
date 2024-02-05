<?php

namespace App\Http\Controllers;

use App\Models\Welcome;
use App\Models\staf;
use App\Models\Asatidlist;
use App\Models\Berita;
use App\Models\Gallerie;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index(Request $request)
    {
        $jumlahStaf = staf::count();
        $jumlahAsatidlist = Asatidlist::count();
        $jumlahBerita = Berita::count();
        $jumlahGallerie = Gallerie::count();

        $cstaf = $request->input('cstaf');
        $staf = staf::where('nama', 'LIKE', '%' . $cstaf . '%')->get();
        $asatid = $request->input('asatid');
        $asatidlist = Asatidlist::where('nama', 'LIKE', '%' . $asatid . '%')->get();
        $cberita = $request->input('cberita');
        $beritas = Berita::where('judul_berita', 'LIKE', '%' .$cberita . '%')->get();
        $cgallerie = $request->input('cgallerie');
        $gallerie = Gallerie::where('nama_gallery', 'LIKE', '%' .$cgallerie . '%')->get();

        return view('welcome', [
            'jumlahStaf' => $jumlahStaf,
            'jumlahAsatidlist' => $jumlahAsatidlist ,
            'jumlahBerita' => $jumlahBerita,
            'jumlahGallerie' => $jumlahGallerie,
            'cstaf'=>$cstaf,
            'staf' => $staf,
            'asatid'=>$asatid,
            'asatidlist' => $asatidlist,
            'cberita' => $cberita,
            'beritas' => $beritas,
            'cgallerie' => $cgallerie,
            'gallerie' => $gallerie,
        ]);

    }
}
