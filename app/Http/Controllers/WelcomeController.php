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
        $perPage = 8;

        $jumlahAsatidlist = Asatidlist::count();
        $jumlahBerita = Berita::count();
        $jumlahGallerie = Gallerie::count();


        $asatidlist = Asatidlist::paginate($perPage);
        $beritas = Berita::paginate($perPage);
        $gallerie = Gallerie::paginate($perPage);

        $casatidlist = $request->input('casatidlist');
        $asatidlist = Asatidlist::where('nama', 'LIKE', '%' . $asatidlist . '%')->paginate($perPage);
        $cberita = $request->input('cberita');
        $beritas = Berita::where('judul_berita', 'LIKE', '%' .$cberita . '%')->paginate($perPage);
        $cgallerie = $request->input('cgallerie');
        $gallerie = Gallerie::where('nama_gallery', 'LIKE', '%' .$cgallerie . '%')->paginate($perPage);

        return view('welcome', [
            'jumlahAsatidlist' => $jumlahAsatidlist ,
            'jumlahBerita' => $jumlahBerita,
            'jumlahGallerie' => $jumlahGallerie,
            'casatidlist'=>$casatidlist,
            'asatidlist' => $asatidlist,
            'cberita' => $cberita,
            'beritas' => $beritas,
            'cgallerie' => $cgallerie,
            'gallerie' => $gallerie,
        ]);

    }
}
