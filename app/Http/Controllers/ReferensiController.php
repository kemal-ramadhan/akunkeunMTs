<?php

namespace App\Http\Controllers;

use App\Models\Guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReferensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.based.guru.index', [
            'title' => 'Data Guru',
            'active' => 'guru',
            'gurus' => Guru::all(),
            'total' => Guru::count()
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
    
    public function storeGuru(Request $request)
    {
        DB::table('gurus')->insertOrIgnore([
            'nuptk' => $request->nuptk,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tanggal_lahir' => $request->tanggal,
            'tempat_lahir' => $request->tempat,
            'email' => $request->email,
            'no_telepon' => $request->no_telp,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('ref-guru')->with('success', 'Data Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.based.guru.detail', [
            'title' => 'Data Siswa',
            'active' => 'guru',
            'guru' => Guru::find($id),
        ]);
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
    public function updateGuru(Request $request)
    {
        DB::table('gurus')
        ->where('id', $request->IdGuru)
        ->update([
            'nuptk' => $request->nuptk,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'tanggal_lahir' => $request->tanggal,
            'tempat_lahir' => $request->tempat,
            'email' => $request->email,
            'no_telepon' => $request->no_telp,
            'password' => bcrypt($request->password),
            'status' => $request->status,
            'updated_at' => now(),
        ]);

        return redirect()->route('DetailGuru', ['id' => $request->IdGuru])->with('success', 'Data Telah Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
