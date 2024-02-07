<?php

use App\Models\Klssantri;
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
            $table->foreignId('klssantri_id')->nullable()->constrained('klssantris')->onUpdate('cascade')->onDelete('restrict');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('nisn')->unique();
            $table->string('telepon')->unique();
            $table->string('alamat');
            $table->enum('jenis_kelamin', ['Laki-laki','Perempuan']);
            $table->string('tempat_lahir');
            $table->date('tanggal_lahir');
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
        return DB::table('kelulusan')->where('santri_id')->exists()|| DB::table('syahriah')->where('santri_id')->exists();
    }
};
