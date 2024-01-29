<?php

namespace App\Http\Controllers;

use App\Models\santri;
use App\Models\syahriah;
use Illuminate\Http\Request;

class SyahriahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $syahriah = syahriah::all();
        $santri = santri::all();
        return view('syahriah.syahriah', compact('syahriah','santri'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $syahriah = syahriah::all();
        $santri = santri::all();
        return view('syahriah.syahriah', compact('santri','syahriah'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      $request->validate([
        'santri_id' => 'required',
      ]);

      syahriah::create([
        'santri_id' => $request->input('santri_id'),
      ]);

    // syahriah::create($request);


      return redirect()->route('syahriah.index')->with('success', 'SYAHRIAH BERHASIL DITAMBAHKAN');
    }

    /**
     * Display the specified resource.
     */
    public function show(syahriah $syahriah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(syahriah $syahriah)
    {
        $syahriah = syahriah::all();
        $santri = santri::all();
        return view('syahriah.syahriah', compact('santri','syahriah'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(syahriah $syahriah)
    {
        $syahriah->delete();
        return redirect()->route('syahriah.index')->with('success', 'SYAHRIAH BERHASIL DIHAPUS');
    }
}
