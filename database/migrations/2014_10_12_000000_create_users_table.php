<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
     function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asatidlist_id')->nullable()->constrained('asatidlists')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('staf_id')- lable()->constrained('stafs')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->default();
            $table->enum('role', ['admin', 'user', 'staf', 'santri', 'asatidlist']);
            $table->rememberToken();
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('users');
    }
}

