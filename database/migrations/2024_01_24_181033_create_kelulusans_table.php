    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;

    return new class extends Migration
    {
        public function up()
        {
            Schema::create('kelulusans', function (Blueprint $table) {
                $table->id();
                $table->foreignId('santri_id')->constrained()->onDelete('cascade');
                $table->string('no_ujian')->nullable();
                $table->integer('nilai');
                $table->string('keterangan')->nullable();
                $table->timestamps();
                $table->foreignId('mapel_id')->constrained()->onDelete('cascade');
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('kelulusans');
        }
    };
