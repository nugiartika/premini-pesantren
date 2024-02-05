<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

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
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('nik')->unique();
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
            $table->string('alamat');
            $table->string('nama_ortu');
            $table->string('telepon_rumah');
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
        return DB::table('santri')->where('pendaftaran_id', '=', $someValue)->exists();
    }
};
