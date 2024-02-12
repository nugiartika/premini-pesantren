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
                $table->string('nama');
                $table->string('nisn')->unique();
                $table->unsignedBigInteger('klssantri_id');
                $table->string('no_ujian')->nullable();
                $table->unsignedBigInteger('mapel_id')->nullable();
                $table->integer('nilai')->nullable();
                $table->decimal('nilairatarata')->nullable();
                $table->string('keterangan')->nullable();
                $table->timestamps();

                $table->foreign('mapel_id')->references('id')->on('mapels')->onUpdate('cascade')->onDelete('restrict');
                $table->foreign('klssantri_id')->references('id')->on('klssantris')->onDelete('cascade'); // Menambah foreign key untuk kelas
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('kelulusans');
        }
    };
