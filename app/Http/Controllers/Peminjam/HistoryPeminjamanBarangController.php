<?php

namespace App\Http\Controllers\Peminjam;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryPeminjamanBarangController extends Controller
{
    public function index() {
        $data = Peminjaman::where('user_id', Auth::user()->id)->get();
        
        return view('content.pages.peminjam.history-peminjaman-barang.index', compact('data'));
    }
}
