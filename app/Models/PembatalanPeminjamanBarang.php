<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembatalanPeminjamanBarang extends Model
{
    use HasFactory;
    protected $table = 'pembatalan_peminjaman_barang';
    protected $primarykey = 'id';
    protected $fillable = ['peminjaman_id', 'alasan_pembatalan'];

    public function peminjaman() {
        return $this->belongsTo(Peminjaman::class);
    }
}
