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
        'produk_id', 
        'alamat', 
        'harga_plano', 
        'jml_total', 
        'total_harga',
        'payment_type',
        'payment_code',
        'pdf_url',
        'gramasi', 
        'laminasi',
        'gambar',
        'request_desain',
        'metode_pengambilan',
        'status',
        'snap_token',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function produk()
    {
        return $this->belongsTo(Product::class, 'produk_id', 'id');
    }

    public function kalender()
    {
        return $this->hasOne(Kalender::class, 'transaksi_id', 'id');
    }

    public function undangan()
    {
        return $this->hasOne(Undangan::class, 'transaksi_id', 'id');
    }

    public function brosur()
    {
        return $this->hasOne(Brosur::class, 'transaksi_id', 'id');
    }

    public function buku()
    {
        return $this->hasOne(Buku::class, 'transaksi_id', 'id');
    }
    
    public function majalah()
    {
        return $this->hasOne(Majalah::class, 'transaksi_id', 'id');
    }
}
