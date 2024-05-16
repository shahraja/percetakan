<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    protected $fillable = ['token_user', 'tgl_transaksi', 'nama', 'produk', 'waktu', 'gambar'];
}
