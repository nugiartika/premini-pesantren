<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;
    protected $table = 'beritas';
    protected $guarded = ['id'];


    public function Kategori()
    {
        return $this->belongsTo(Kategori::class);
    }
<<<<<<< Updated upstream

    public static function getJumlahKelulusan()
    {
        return Kelulusan::count();
    }
=======
>>>>>>> Stashed changes
}
