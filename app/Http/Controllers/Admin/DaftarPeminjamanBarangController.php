<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\PembatalanPeminjamanBarang;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;

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
        if($request->status == 'Dikonfirmasi') {
            $user = User::find($peminjaman->user_id);

            $pdf = Pdf::loadView('content.pages.admin.daftar-peminjaman-barang.bukti-peminjaman-barang-pdf', [
                'data' => $peminjaman,
                'user' => $user
            ])->setPaper('a4', 'potrait');

            $folder = public_path('Bukti Peminjaman Barang/');

            if (!File::exists($folder)) {
                File::makeDirectory($folder, 0755, true);
            }

            $filename = $user->name . ' ' . $peminjaman->tanggal_peminjaman . '-' . $peminjaman->tanggal_pengembalian .'.pdf';
            $filePath = $folder . '/' . $filename;

            $pdf->save($filePath);

            $peminjaman->url_bukti_peminjaman_barang = 'Bukti Peminjaman Barang/' . $filename;
            $peminjaman->status = $request->status;
            
            $peminjaman->save();
    
            $barang = Barang::where('id', $peminjaman->barang_id)->first();
            $barang->stok -= $peminjaman->jumlah;
            
            $barang->save();

        } else {
            $peminjaman->status = 'Ditolak';
            $peminjaman->save();

            $tolakPeminjaman = new PembatalanPeminjamanBarang();
            $tolakPeminjaman->peminjaman_id = $id;
            $tolakPeminjaman->alasan_pembatalan = $request->alasan_pembatalan;
            $tolakPeminjaman->save();
        }

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
