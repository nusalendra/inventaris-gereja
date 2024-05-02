<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'kategori_id', 'barang_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'lokasi_barang', 'jumlah', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function barang() {
        return $this->belongsTo(Barang::class);
    }

    public function pembatalanPeminjamanBarang() {
        return $this->hasOne(PembatalanPeminjamanBarang::class);
    }
}
