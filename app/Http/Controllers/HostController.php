<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('public.index', [
            'title' => 'Beranda',
            'active' => 'beranda',
        ]);
    }
    
    public function indexProduk()
    {
        return view('public.produk', [
            'title' => 'Pembayaran',
            'active' => 'pembayaran',
        ]);
    }
    
    public function indexDetail()
    {
        return view('public.detail', [
            'title' => 'Detail Pembayaran',
            'active' => 'pembayaran',
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
