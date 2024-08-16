<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailValueUkuran extends Model
{
    use HasFactory;

    protected $table = 'detail_value_ukuran';
    protected $fillable = 
    [
        'id', 
        'detail_ukuran_id', 
        'nama_value_ukuran', 
        'value',
    ];

    public function detail_ukuran()
    {
        return $this->belongsTo(DetailUkuran::class, 'detail_ukuran_id', 'id');
    }
}
