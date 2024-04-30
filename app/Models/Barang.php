<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table = 'barang';
    protected $primarykey = 'id';
    protected $fillable = ['nama', 'stok', 'gambar'];

    public function peminjaman() {
        return $this->hasMany(Peminjaman::class);
    }
}
