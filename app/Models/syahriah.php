<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syahriah extends Model
{
    use HasFactory;
    protected $fillable = [
        'santri_id'
    ];

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }


}
