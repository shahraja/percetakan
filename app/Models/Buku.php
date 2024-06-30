<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'transaksi_buku';
    protected $fillable = [
        'transaksi_id',
        'halaman',
        'finishing',
        'uk_asli',
        'uk_width',
        'uk_height'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
}
