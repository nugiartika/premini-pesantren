<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'judul_berita',
    //     'slug',
    //     'kategori_id',
    //     'tanggal',
    //     'user_posting',
    //     'foto'
    // ];
    protected $table = 'beritas';
    protected $primaryKey = 'id';
    protected $guarded = [];

    public $incrementing = true;
    public $timestamps = true;

    public function Kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
    public static function getJumlahKelulusan()
    {
        return Kelulusan::count();
    }
}
