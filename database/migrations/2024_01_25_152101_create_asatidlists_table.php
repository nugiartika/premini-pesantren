<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('asatidlists', function (Blueprint $table) {
            $table->id();
            $table->string('nip');
            $table->string('nama');
            $table->string('ttl');
            $table->string('alamat');
            $table->string('pendidikan');
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ($this->checkRelationships()) {
            Session::flash('warning', 'Data ASATID masih digunakan dan tidak dapat dihapus.');

            return;
        }
        Schema::dropIfExists('asatidlists');
    }
    private function checkRelationships()
    {
        return DB::table('asatid')->where('asatidlist_id', '=', $someValue)->exists();
    }
};
