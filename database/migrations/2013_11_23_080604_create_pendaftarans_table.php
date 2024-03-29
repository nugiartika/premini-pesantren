<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('nisn')->unique();
            $table->string('telepon')->unique();
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->enum('status', ['menunggu konfirmasi','Diterima','Ditolak'])->default('menunggu konfirmasi');
            $table->timestamps();
         });
    }

    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'DATA ASATID MASIH DIGUNAKAN DAN TIDAK DAPAT DIHAPUS.');

            return;
        }
        Schema::dropIfExists('pendaftarans');
    }
    private function checkRelationships()
    {
        return DB::table('santri')->where('pendaftaran_id')->exists();
    }
};
