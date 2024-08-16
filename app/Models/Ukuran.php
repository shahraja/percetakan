<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ukuran extends Model
{
    use HasFactory;

    protected $table = 'ukuran';
    protected $fillable = 
    [
        'id', 
        'product_id', 
        'nama_ukuran',
    ];

    public function produk()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function detail_ukuran()
    {
        return $this->hasMany(DetailUkuran::class, 'ukuran_id', 'id');
    }
}
