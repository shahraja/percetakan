<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Majalah extends Model
{
    protected $table = 'transaksi_majalah';
    protected $fillable = [
        'transaksi_id',
        'halaman', 
        'finishing',
        'uk_asli', 
        'uk_width', 
        'uk_height'];
}
