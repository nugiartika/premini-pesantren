<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;
    


    protected $table = 'pendaftarans';
    protected $guarded = ['id'];


    public function santri()
    {
        return $this->hasMany(Santri::class);
    }
}
