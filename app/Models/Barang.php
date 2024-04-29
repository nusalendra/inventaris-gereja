<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primarykey = 'id';
    protected $fillable = ['kategori_id', 'nama', 'stok', 'gambar'];

    public function kategori() {
        return $this->belongsTo(Kategori::class);
    }

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class);
    }
}
