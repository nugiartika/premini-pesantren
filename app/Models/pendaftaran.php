<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_lengkap',
        'email',
        'jns_kelamin',
        'nik',
        'tempat_lahir',
        'alamat',
        'tempat_tinggal',
        'nama_ortu',
        'pendidikan_ortu',
        'pekerjaan_ortu',
        'sekolah_asal',
        'telepon_rumah'
    ];
}
