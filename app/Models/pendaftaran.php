<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;
    // protected $fillable = [
    //     'nama_lengkap',
    //     'jenis_kelamin',
    //     'nik',
    //     'tempat_lahir',
    //     'tanggal_lahir',
    //     'alamat',
    //     'nama_ortu',
    //     'telepon_rumah',
    //     'status'
    // ];


    protected $table = 'pendaftarans';
    protected $guarded = ['id'];


    public function santri()
    {
        return $this->hasMany(Santri::class);
    }
}
