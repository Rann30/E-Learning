<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('assignments', function (Blueprint $table) {
            $table->id();

            // RELASI UTAMA
            $table->foreignId('course_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                  ->constrained('users')
                  ->cascadeOnUpdate()
                  ->restrictOnDelete();

            // DATA TUGAS
            $table->string('title');
            $table->text('description');
            $table->timestamp('deadline');
            $table->integer('max_score')->default(100);
            $table->string('file')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('assignments');
    }
};
