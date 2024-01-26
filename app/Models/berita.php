<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $fillable = [
        'judul_berita',
        'slug',
        'kategori_id',
        'tanggal',
        'user_posting',
        'sampul'
    ];

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

}
