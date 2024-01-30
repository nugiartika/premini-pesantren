<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class santri extends Model
{
    use HasFactory;
    protected $fillable = [
        'nis',
        'pendaftaran_id',
        'klssantri_id',
    ];
    public function klssantri()
    {
        return $this->belongsTo(Klssantri::class);
    }
    public function kelulusan()
    {
        return $this->hasMany(Kelulusan::class);
    }
    public function syahriah()
    {
        return $this->hasMany(Syahriah::class);
    }
    public function pendaftaran()
    {
        return $this->belongsTo(Pendaftaran::class);
    }
}
