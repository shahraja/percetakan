<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'foto',
        'name',
        'email',
        'password',
        'no_telp',
        'alamat',
        'provinsi',
        'kota',
        'kecamatan',
        'role'
    ];

    protected $hidden = [
        'password',
    ];
}
