<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_gallery',
        'slug',
        'tanggal',
        'user_posting',
        'sampul'
    ];

}
