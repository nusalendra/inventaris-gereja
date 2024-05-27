<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $data = Peminjaman::where('status', 'Dikembalikan')->get();

        return view('content.pages.admin.laporan.index', compact('data'));
    }

    public function cetakPDF() {
        $data = Peminjaman::where('status', 'Dikembalikan')->get();
        $pdf = Pdf::loadView('content.pages.admin.laporan.cetak-pdf', ['data' => $data])
                   ->setPaper('a4', 'landscape');
        return $pdf->stream('laporan-peminjaman-barang.pdf');
    }

    public function laporanDibatalkan() {
        $data = Peminjaman::where('status', 'Dibatalkan')->orWhere('status', 'Ditolak')->get();
        
        return view('content.pages.admin.laporan-dibatalkan.index', compact('data'));
    }
}
