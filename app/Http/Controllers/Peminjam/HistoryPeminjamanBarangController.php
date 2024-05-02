<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HistoryPeminjamanBarangController extends Controller
{
    public function index() {
        $data = Barang::all();

        $tanggalSekarang = Carbon::now()->toDateString();
        
        return view('content.pages.peminjam.history-peminjaman-barang.index', compact('data', 'tanggalSekarang'));
    }
}
