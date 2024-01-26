<?php

namespace App\Http\Controllers;

use App\Models\Umum;
use Carbon\Carbon;
use App\Http\Requests\StoreUmumRequest;
use App\Http\Requests\UpdateUmumRequest;

class UmumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $umum = Umum::all();
        return view('umum.umum', compact('umum'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $umum = Umum::all();
        return view('umum.umum', compact('umum'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUmumRequest $request)
    {
        $request->validate([
            'judul_pengumuman' => 'required|unique:umums,judul_pengumuman',
            'tanggal' => 'required|date|after_or_equal:today',
        ], [
            'judul_pengumuman.required' => 'Kolom JUDUL PENGUMUMAN wajib diisi.',
            'judul_pengumuman.unique' => 'JUDUL PENGUMUMAN sudah digunakan.',
            'tanggal.required' => 'Kolom TANGGAL  wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL  harus berupa tanggal.',
            'tanggal.after_or_equal' => 'Kolom TANGGAL harus setelah atau sama dengan tanggal sekarang.',
        ]);

        Umum::create([
            'judul_pengumuman' => $request->input('judul_pengumuman'),
            'tanggal' => $request->input('tanggal'),
        ]);

        return redirect()->route('umum.index')->with('success', 'PENGUMUMAN UMUM berhasil ditambahkan');

    }

    /**
     * Display the specified resource.
     */
    public function show(Umum $umum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umum $umum)
    {
        $umum = Umum::all();
        return view('umum.umum', compact('umum'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUmumRequest $request, Umum $umum)
    {
        $request->validate([
            'judul_pengumuman' => 'required|unique:umums,judul_pengumuman',
            'tanggal' => 'required|date|after_or_equal:today',
        ], [
            'judul_pengumuman.required' => 'Kolom JUDUL PENGUMUMAN wajib diisi.',
            'judul_pengumuman.unique' => 'JUDUL PENGUMUMAN sudah digunakan.',
            'tanggal.required' => 'Kolom TANGGAL  wajib diisi.',
            'tanggal.date' => 'Kolom TANGGAL  harus berupa tanggal.',
            'tanggal.after_or_equal' => 'Kolom TANGGAL harus setelah atau sama dengan tanggal sekarang.',
        ]);
        $umum->update([
            'judul_pengumuman' => $request->input('judul_pengumuman'),
            'tanggal' => $request->input('tanggal'),
        ]);
        return redirect()->route('umum.index')->with('success', 'PENGUMUMAN UMUM berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Umum $umum)
    {
        $umum->delete();
        return redirect()->route('umum.index')->with('success', 'PENGUMUMAN UMUM berhasil dihapus');
    }
}
