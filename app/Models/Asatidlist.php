<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asatidlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'nip',
        'nama',
        'ttl',
        'alamat',
        'pendidikan',
        'foto'
    ];
    
    public function asatid()
    {
        return $this->hasMany(Asatid::class);
    }
}
