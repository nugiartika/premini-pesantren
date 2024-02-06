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
        'tempat_lahir',
        'ttl',
        'alamat',
        'pendidikan',
        'foto'
    ];

<<<<<<< Updated upstream
    public function asatidlist()
    {
        return $this->hasMany(Asatidlist::class);
    }

=======
    
>>>>>>> Stashed changes
    public function klssantri()
    {
        return $this->hasMany(Klssantri::class);
    }

}
