<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelulusan extends Model
{
    use HasFactory;
// app\Models\Kelulusan.php

protected $fillable = [
    'santri_id', 'no_ujian', 'mapel_id', 'nilai', 'nilairatarata', 'keterangan',
];
    
        public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
    public function santri()
    {
        return $this->belongsTo(Santri::class);
    }

}
