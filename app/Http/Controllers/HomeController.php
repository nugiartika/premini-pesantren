<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Gallerie;
use App\Models\Umum;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $jumlahGallery = Gallerie::count();
        $jumlahBerita = Berita::count();
        // $jumlahKelulusan = Kelulusan::count();
        $jumlahPengumuman = Umum::count();

        return view('home', [
            'jumlahGallery' => $jumlahGallery,
            'jumlahBerita' => $jumlahBerita,
            // 'jumlahKelulusan' => $jumlahKelulusan,
            'jumlahPengumuman' => $jumlahPengumuman,
        ]);
    }
}
