<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staf extends Model
{
    use HasFactory;

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'tempat_lahir',
        'ttl',
        'alamat',
        'pendidikan',
        'jabatan',
        'foto',
    ];
    
    public function user()
    {
        return $this->hasOne(user::class);
    }

}
