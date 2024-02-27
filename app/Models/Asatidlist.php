<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asatidlist extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function user()
    {
        return $this->hasOne(user::class);
    }
    public function klssantri()
    {
        return $this->hasMany(Klssantri::class);
    }

}
