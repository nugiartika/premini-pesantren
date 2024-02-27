<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mapel extends Model
{
    use HasFactory;
    protected $table ='mapels';
    protected $guarded =['id'];
    public function asatidlist()
    {
        return $this->hasMany(Asatidlist::class);
    }
    public function kelulusan()
    {
        return $this->hasMany(Kelulusan::class);
    }

}
