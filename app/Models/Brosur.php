<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brosur extends Model
{
    protected $table = 'transaksi_brosur';
    protected $fillable = ['transaksi_id', 'nama_produk', 'uk_asli', 'uk_width', 'uk_height'];
}
