<?php

namespace App\Http\Controllers\Admin;

use App\Charts\JumlahBarangChart;
use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(JumlahBarangChart $jumlahBarangChart)
  {
    $totalUser = User::where('role', 'Peminjam')->count();
    $peminjamanBelumKonfirmasi = Peminjaman::where('status', 'Belum Dikonfirmasi')->count();
    $peminjamanSelesai = Peminjaman::where('status', 'Dikembalikan')->count();
    
    $peminjamanDibatalkan = Peminjaman::where('status', 'Dibatalkan')->count();
    $peminjamanDitolak = Peminjaman::where('status', 'Ditolak')->count();
    $totalPeminjamanGagal = $peminjamanDibatalkan + $peminjamanDitolak;

    return view('content.pages.admin.dashboard.index', compact('totalUser', 'peminjamanBelumKonfirmasi', 'peminjamanSelesai', 'totalPeminjamanGagal') ,['jumlahBarangChart' => $jumlahBarangChart->build()]);
  }
}
