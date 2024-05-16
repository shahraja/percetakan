<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'cart';
    protected $fillable = ['no_pesanan', 'nama', 'alamat', 'nama_produk', 'sisi', 'ukuran', 'jumlah_total', 'lipat', 'harga', 'laminasi', 'status'];
}
