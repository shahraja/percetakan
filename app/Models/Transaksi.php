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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function Kalender()
    {
        return $this->belongsTo(Kalender::class, 'transaksi_id', 'id');
    }

    public function Undangan()
    {
        return $this->belongsTo(Undangan::class, 'transaksi_id', 'id');
    }

    public function Brosur()
    {
        return $this->belongsTo(Brosur::class, 'transaksi_id', 'id');
    }

    public function Buku()
    {
        return $this->belongsTo(Buku::class, 'transaksi_id', 'id');
    }
    
    public function Majalah()
    {
        return $this->belongsTo(Majalah::class, 'transaksi_id', 'id');
    }
}
