<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class DaftarPeminjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Peminjaman::where('status', '=', 'Belum Dikonfirmasi')->get();
        return view('content.pages.admin.daftar-peminjaman-barang.index', compact('data'));
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
        
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = $request->status;
        
        $peminjaman->save();

        $barang = Barang::where('id', $peminjaman->barang_id)->first();
        $barang->stok -= $peminjaman->jumlah;
        
        $barang->save();

        return redirect('/daftar-peminjaman-barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
