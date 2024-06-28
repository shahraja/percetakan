<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    protected $table = 'transaksi_kalender';
    protected $fillable = [
        'transaksi_id',
        'lembar', 
        'jilid', 
        'uk_asli', 
        'uk_width', 
        'uk_height'];

    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'transaksi_id', 'id');
    }
}
