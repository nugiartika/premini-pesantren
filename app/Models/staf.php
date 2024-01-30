<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class staf extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'nip',
    //     'nama',
    //     'ttl',
    //     'alamat',
    //     'pendidikan',
    //     'jabatan',
    //     'foto'
    // ];
    protected $table = 'stafs';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $incrementing = true;
    public $timestamps = true;
}
