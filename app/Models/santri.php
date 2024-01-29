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
        'klssantri_id',
        'alamat',
        'ttl',
        'jns_kelamin'
    ];
    public function klssantri()
    {
        return $this->belongsTo(Klssantri::class);
    }
    public function kelulusan()
    {
        return $this->hasMany(Kelulusan::class);
    }
}
