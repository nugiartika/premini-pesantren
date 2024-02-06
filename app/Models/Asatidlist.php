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
        'email',
        'tempat_lahir',
        'ttl',
        'alamat',
        'pendidikan',
        'foto'
    ];
    public function user()
    {
        return $this->hasOne(user::class);
    }
    public function updateUsers(array $data)
    {
        $this->user->update($data);
    }
    public function klssantri()
    {
        return $this->hasMany(Klssantri::class);
    }

}
