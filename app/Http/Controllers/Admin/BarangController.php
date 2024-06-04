<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::all();
        return view('content.pages.admin.barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.pages.admin.barang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $barang = new Barang();
        $barang->nama = $request->nama;
        $barang->stok = $request->stok;
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $filename = $barang->nama . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gambar-barang'), $filename);
            $barang->gambar = $filename;
        }
        $barang->lokasi_barang = $request->lokasi_barang;
        $barang->hari_batas_peminjaman = $request->hari_batas_peminjaman;

        $barang->save();

        return redirect('/barang');
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
        $data = Barang::find($id);

        return view('content.pages.admin.barang.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = Barang::find($id);
        $barang->nama = $request->nama;
        $barang->stok = $request->stok;
        if ($request->hasfile('gambar')) {
            if ($barang->gambar) {
                File::delete('gambar-barang/' . $barang->gambar);
            }

            $file = $request->file('gambar');
            $filename = $barang->nama . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('gambar-barang'), $filename);
            $barang->gambar = $filename;
        }
        
        $barang->lokasi_barang = $request->lokasi_barang;
        $barang->hari_batas_peminjaman = $request->hari_batas_peminjaman;
        
        $barang->save();

        return redirect('/barang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = Barang::find($id);
        File::delete('gambar-barang/' . $barang->gambar);

        $barang->delete();

        return redirect('/barang');
    }
}
