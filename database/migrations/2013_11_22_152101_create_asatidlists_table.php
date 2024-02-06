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
        Schema::create('asatidlists', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->default('')->unique();
            $table->string('nama');
            $table->string('email');
            $table->string('tempat_lahir');
            $table->date('ttl');
            $table->string('alamat');
            $table->string('pendidikan');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'DATA ASATID MASIH DIGUNAKAN DAN TIDAK DAPAT DIHAPUS.');

            return;
        }
        Schema::dropIfExists('asatidlists');
    }
    private function checkRelationships($asatidlistId)
    {
        return DB::table('asatid')->where('asatidlist_id', $asatidlistId)->exists() || DB::table('klssantri')->where('asatidlist_id', $asatidlistId)->exists();
    }
};
