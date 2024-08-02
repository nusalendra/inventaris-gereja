<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class ProsesPeminjamanBarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        
        $data = Peminjaman::where('user_id', $user->id)
            ->where(function($query) {
                $query->where('status', 'Belum Dikonfirmasi')
                      ->orWhere('status', 'Dikonfirmasi')
                      ->orWhere('status', 'Dikembalikan');
            })
            ->get();
        
        return view('content.pages.peminjam.proses-peminjaman-barang.index', compact('data'));
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
        $data = Peminjaman::find($id);
        $data->status = 'Dikembalikan';
        $data->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function unduhBuktiPeminjamanBarang($id) {
        $data = Peminjaman::find($id);

        $filePath = public_path($data->url_bukti_peminjaman_barang);

        if (File::exists($filePath)) {
            return Response::download($filePath);
        }
    }
}
