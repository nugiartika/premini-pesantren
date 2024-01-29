<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;
    protected $fillable = [
        'santri_id',
        'no_ujian',
        'klssantri_id',
        'mapel_id',
        'nilai',
        'status'
    ];
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }
    public function klssantri()
    {
        return $this->belongsTo(Klssantri::class);
    }
}
