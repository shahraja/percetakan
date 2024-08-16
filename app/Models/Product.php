<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $table = 'product';
    protected $fillable = 
    [
        'judul', 
        'kertas', 
        'gambar', 
        'deskripsi', 
        'harga', 
        'sisi', 
        'ukuran',
        'spesifikasi'
    ];
    
    protected $casts = [
        'spesifikasi' => 'array'
    ];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class, 'product_id', 'id');
    }

    public function ukuran()
    {
        return $this->hasMany(Ukuran::class, 'product_id', 'id');
    }
}
