<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Klssantri extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function asatidlist()
    {
        return $this->belongsTo(Asatidlist::class);
    }
    public function santri()
    {
        return $this->hasMany(Santri::class);
    }

}
