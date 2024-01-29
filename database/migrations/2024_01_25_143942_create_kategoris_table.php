<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('kategoris', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'DATA ASATID MASIH DIGUNAKAN DAN TIDAK DAPAT DIHAPUS.');

            return;
        }
        Schema::dropIfExists('kategoris');
    }
    private function checkRelationships()
    {
        return DB::table('berita')->where('kategori_id', '=', $someValue)->exists();
    }
};
