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
        Schema::create('mapels', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'DATA MAPEL MASIH DIGUNAKAN DAN TIDAK DAPAT DIHAPUS.');

            return;
        }
        Schema::dropIfExists('mapels');
    }
    private function checkRelationships($mapelId)
    {
        return DB::table('asatids')->where('mapel_id', $mapelId)->exists() || DB::table('kelulusan')->where('mapel_id', $mapelId)->exists();
    }
};
