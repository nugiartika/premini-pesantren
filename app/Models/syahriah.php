<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class syahriah extends Model
{
    use HasFactory;
    protected $table = 'syahriahs';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $incrementing = true;
    public $timestamps = true;

    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }


}
