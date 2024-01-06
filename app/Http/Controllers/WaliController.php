<?php

namespace App\Http\Controllers;

use App\Models\Orangtuawali;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WaliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.based.wali.index',[
            'title' => "Data Orang Tua Wali",
            'active' => "wali",
            'walis' => Orangtuawali::all(),
            'total' => Orangtuawali::count(),
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
    
    public function storeWali(Request $request)
    {
        DB::table('orangtuawalis')->insertOrIgnore([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'no_telepon' => $request->no_telp,
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('waliIndex')->with('success', 'Data Telah Ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        return view('admin.based.wali.detail', [
            'title' => "Data Orang Tua Wali",
            'active' => "wali",
            'wali' => Orangtuawali::find($id)
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
    public function update(Request $request, string $id)
    {
        //
    }
    
    public function updateWali(Request $request)
    {
        DB::table('orangtuawalis')
        ->where('id', $request->idWali)
        ->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'email' => $request->email,
            'no_telepon' => $request->no_telp,
            'alamat' => $request->alamat,
            'status' => $request->status,
            'updated_at' => now()
        ]);

        return redirect()->route('Detailwali', ['id' => $request->idWali])->with('success', 'Data Telah Diperbaharui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
