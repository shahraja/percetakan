<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brosur extends Model
{
    protected $table = 'transaksi_brosur';
    protected $fillable = [
        'transaksi_id',
        'uk_asli',
        'uk_width',
        'uk_height'
    ];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
}
