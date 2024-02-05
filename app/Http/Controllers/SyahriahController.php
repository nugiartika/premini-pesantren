<?php

namespace App\Http\Controllers;

use App\Models\santri;
use App\Models\syahriah;
use App\Http\Requests\SyahriahRequest;
use Illuminate\Http\Request;

class SyahriahController extends Controller
{

    public function index()
    {
        $syahriah = Syahriah::all();
        $santri = Santri::all();
        return view('syahriah.syahriah', compact('syahriah','santri'));
    }


    public function create()
    {
        $syahriah = Syahriah::all();
        $santri = Santri::all();
        return view('syahriah.syahriah', compact('syahriah','santri'));
    }

    public function store(SyahriahRequest $request)
    {
        $request->validate([
            'santri_id' => 'required',
        ]);

        Syahriah::create([
            'santri_id' => $request->input('santri_id'),
        ]);
        return redirect()->route('syahriah.index')->with('success', 'SYAHRIAH BERHASIL DITAMBAHKAN');
    }


    public function show(syahriah $syahriah)
    {
        //
    }


    public function edit(syahriah $syahriah)
    {
        $syahriah = Syahriah::all();
        $santri = Santri::all();
        return view('syahriah.syahriah', compact('syahriah','santri'));
    }


    public function update(Request $request, syahriah $syahriah)
    {
        $request->validate([
            'santri_id' => 'required',
        ]);

        $syahriah->update([
            'santri_id' => $request->input('santri_id'),
        ]);

        return redirect()->route('syahriah.index')->with('success', 'SYAHRIAH BERHASIL DIUPDATE');
    }


    public function destroy(syahriah $syahriah)
    {
        $syahriah->delete();
        return redirect()->route('syahriah.index')->with('success', 'SYAHRIAH BERHASIL DIHAPUS');
    }
}
