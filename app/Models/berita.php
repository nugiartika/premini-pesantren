<?php

namespace App\Models;
use App\Models\Kelulusan;
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
        return $this->belongsTo(Kategori::class);
    }
    public static function getJumlahKelulusan()
    {
        return Kelulusan::count();
    }
}
