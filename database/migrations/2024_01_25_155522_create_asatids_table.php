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
        Schema::create('asatids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asatidlist_id')->constrained('asatidlists')->onDelete('restrict');
            $table->foreignId('mapel_id')->constrained()->onDelete('restrict');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('asatids');
    }
};
