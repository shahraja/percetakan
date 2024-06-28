<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    protected $fillable = [
        'user_id', 
        'nomor_pesanan', 
        'nama_produk', 
        'alamat', 
        'harga_plano', 
        'jml_total', 
        'total_harga',
        'gramasi', 
        'laminasi',
        'gambar', 
        'status'];
}
