<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Undangan extends Model
{
    protected $table = 'transaksi_undangan';
    protected $fillable = [
        'transaksi_id', 
        'uk_asli', 
        'uk_width', 
        'uk_height'];
}
