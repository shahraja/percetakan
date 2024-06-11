<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brosur extends Model
{
    protected $table = 'transaksi_brosur';
    protected $fillable = ['nama_produk', 'user_id', 'alamat', 'total_harga', 'harga_plano', 'jumlah', 'gramasi', 'status', 'laminasi', 'uk_asli', 'uk_width', 'uk_height'];
}
