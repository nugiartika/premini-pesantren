<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'nama',
        'alamat',
        'ttl',
        'jns_kelamin'
    ];
}
