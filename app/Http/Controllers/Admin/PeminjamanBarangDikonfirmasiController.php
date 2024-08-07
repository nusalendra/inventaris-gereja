<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\PembatalanPeminjamanBarang;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class PeminjamanBarangDikonfirmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $data = Peminjaman::where('status', '=', 'Dikonfirmasi')->orWhere('status', '=', 'Dikembalikan')->get();
        return view('content.pages.admin.peminjaman-barang-dikonfirmasi.index', compact('data'));
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
        $peminjaman->status = 'Dibatalkan';
        $peminjaman->save();

        $pembatalanPeminjaman = new PembatalanPeminjamanBarang();
        $pembatalanPeminjaman->peminjaman_id = $id;
        $pembatalanPeminjaman->alasan_pembatalan = $request->alasan_pembatalan;
        $pembatalanPeminjaman->save();

        $barang = Barang::where('id', $peminjaman->barang_id)->first();
        $barang->stok += $peminjaman->jumlah;
        $barang->save();
        
        return redirect('/peminjaman-barang-dikonfirmasi');
    }

    public function pengembalianBarang($id) {
        $peminjaman = Peminjaman::find($id);
        $peminjaman->status = 'Selesai';
        $peminjaman->save();

        $barang = Barang::where('id', $peminjaman->barang_id)->first();
        $barang->stok += $peminjaman->jumlah;
        $barang->save();
        
        return redirect('/peminjaman-barang-dikonfirmasi');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
