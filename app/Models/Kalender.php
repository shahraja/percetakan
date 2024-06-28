<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kalender extends Model
{
    protected $table = 'transaksi_kalender';
    protected $fillable = [
        'transaksi_id',
        'isi', 
        'jilid', 
        'uk_asli', 
        'uk_width', 
        'uk_height'];
}
