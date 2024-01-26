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
        'kelas_id',
        'alamat',
        'ttl',
        'jns_kelamin'
    ];


    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }
}
