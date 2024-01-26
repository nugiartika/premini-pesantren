<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asatid extends Model
{
    use HasFactory;
    protected $fillable = [
        'asatidlist_id',
        'mapel_id'
    ];
    
    public function asatidlist()
    {
        return $this->belongsTo(Asatidlist::class);
    }

    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}
