<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'transaksi_buku';
    protected $fillable = ['nama_produk', 'user_id', 'alamat', 'total_harga', 'harga_plano', 'jumlah', 'gramasi', 'status', 'halaman', 'finishing', 'laminasi', 'uk_asli', 'uk_width', 'uk_height'];
}
