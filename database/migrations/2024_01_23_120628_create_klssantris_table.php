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
        Schema::create('klssantris', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kelas');
            $table->foreignId('asatidlist_id')->constrained('asatidlists')->onDelete('restrict');
            $table->timestamps(); 
        });
    }


    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'DATA ASATID MASIH DIGUNAKAN DAN TIDAK DAPAT DIHAPUS.');

            return;
        }
        Schema::dropIfExists('klssantris');
    }
    private function checkRelationships()
    {
        return DB::table('santri')->where('klssantri_id')->exists();
    }
};
