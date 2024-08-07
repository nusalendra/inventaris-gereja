<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $data = Peminjaman::where('status', 'Selesai')->get();

        return view('content.pages.admin.laporan.index', compact('data'));
    }

    public function cetakPDF(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ]);

        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $data = Peminjaman::where('status', 'Selesai')
            ->whereBetween('tanggal_peminjaman', [$startDate, $endDate])
            ->orderBy('tanggal_peminjaman', 'asc')
            ->get();

        $pdf = Pdf::loadView('content.pages.admin.laporan.cetak-pdf', ['data' => $data])
                ->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-peminjaman-barang.pdf');
    }


    public function laporanDibatalkan() {
        $data = Peminjaman::where('status', 'Dibatalkan')->orWhere('status', 'Ditolak')->get();
        
        return view('content.pages.admin.laporan-dibatalkan.index', compact('data'));
    }
}
