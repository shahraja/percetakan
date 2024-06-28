<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'transaksi_buku';
    protected $fillable = ['transaksi_id', 'nama_produk', 'halaman', 'finishing', 'uk_asli', 'uk_width', 'uk_height'];
}
