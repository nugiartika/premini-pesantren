<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    use HasFactory;
    protected $fillable = [
        'klssantri_id',
        'nama',
        'email',
        'nisn',
        'telepon',
        'alamat',
        'jenis_kelamin',
        'tempat_lahir',
        'tanggal_lahir'
    ];
    public function klssantri()
    {
        return $this->belongsTo(Klssantri::class);
    }

    public function kelulusan()
    {
        return $this->hasOne(kelulusan::class);
    }



}

