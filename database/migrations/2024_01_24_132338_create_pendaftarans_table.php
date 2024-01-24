<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pendaftarans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->enum('tempat_tinggal', ['Bersama orang tua/wali','kos','Asrama/Pondok Pesantren','Panti Asuhan','lainnnya']);
            $table->string('nama_ortu');
            $table->string('pendidikan_ortu');
            $table->string('pekerjaan_ortu');
            $table->string('sekolah_asal');
            $table->string('telepon_rumah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendaftarans');
    }
};
