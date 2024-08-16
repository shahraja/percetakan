<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailUkuran extends Model
{
    use HasFactory;

    protected $table = 'detail_ukuran';
    protected $fillable = 
    [
        'id', 
        'ukuran_id', 
        'nama_detail_ukuran', 
        'is_parent',
    ];

    public function ukuran()
    {
        return $this->belongsTo(Ukuran::class, 'ukuran_id', 'id');
    }

    public function detail_value_ukuran()
    {
        return $this->hasMany(DetailValueUkuran::class, 'detail_ukuran_id', 'id');
    }
}
