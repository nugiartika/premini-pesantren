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
        Schema::create('santris', function (Blueprint $table) {
            $table->id();
            $table->integer('nis');
            $table->string('nama');
            $table->foreignId('klssantri_id')->constrained()->onDelete('restrict');
            $table->string('alamat');
            $table->string('ttl');
            $table->string('jns_kelamin');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'DATA ASATID MASIH DIGUNAKAN DAN TIDAK DAPAT DIHAPUS.');

            return;
        }
        Schema::dropIfExists('santris');
    }
    private function checkRelationships()
    {
        return DB::table('kelulusan')->where('santri_id', '=', $someValue)->exists();
    }
};
