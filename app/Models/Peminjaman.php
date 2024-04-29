<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primarykey = 'id';
    protected $fillable = ['user_id', 'barang_id', 'tanggal_peminjaman', 'tanggal_pengembalian', 'jumlah', 'status'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function barang() {
        return $this->belongsTo(Barang::class);
    }
}
