    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Support\Facades\DB;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('kelulusans', function (Blueprint $table) {
                // Define your table columns here
                $table->id();
                $table->foreignId('santri_id')->constrained()->onDelete('restrict');
                $table->string('no_ujian');
                $table->foreignId('mapel_id')->constrained()->onDelete('restrict');
                $table->json('nilai')->nullable();
                $table->decimal('nilairatarata', 5, 2)->nullable();
                $table->string('keterangan')->nullable();
                $table->timestamps();
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('kelulusans');
        }
    };
