<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('search');
        $data = Barang::when($searchTerm, function($query, $searchTerm) {
            return $query->where('nama', 'like', "%{$searchTerm}%");
        })->simplePaginate(8);

        $tanggalSekarang = Carbon::now()->toDateString();

        if ($request->ajax()) {
            return view('content.pages.peminjam.peminjaman-barang.paginate', compact('data'))->render();
        }

        return view('content.pages.peminjam.peminjaman-barang.index', compact('data', 'tanggalSekarang'));
    }

    public function form($id) {
        $barang = Barang::find($id);
        $kategori = Kategori::all();
        return view('content.pages.peminjam.peminjaman-barang.form', compact('barang', 'kategori'));
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
        $user = Auth::user();

        $peminjaman = new Peminjaman();
        $peminjaman->user_id = $user->id;
        $peminjaman->kategori_id = $request->kategori_id;
        $peminjaman->barang_id = $request->barang_id;
        $peminjaman->tanggal_peminjaman = $request->tanggal_peminjaman;
        $peminjaman->tanggal_pengembalian = $request->tanggal_pengembalian;
        $peminjaman->lokasi_barang = $request->lokasi_barang;
        $peminjaman->jumlah = $request->jumlah;
        $peminjaman->status = 'Belum Dikonfirmasi';

        $peminjaman->save();

        return redirect('/peminjaman-barang');
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
