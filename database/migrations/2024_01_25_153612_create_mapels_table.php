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
            Session::flash('warning', 'Data MAPEL masih digunakan dan tidak dapat dihapus.');

            return;
        }
        Schema::dropIfExists('mapels');
    }
    private function checkRelationships()
    {
        return DB::table('asatid')->where('mapel_id', '=', $someValue)->exists();
    }
};
