<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index() {
        $data = Peminjaman::all();

        return view('content.pages.admin.laporan.index', compact('data'));
    }
}
