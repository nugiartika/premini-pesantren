<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallerie extends Model
{
    use HasFactory;
    protected $table = 'galleries';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $incrementing = true;
    public $timestamps = true;


}
