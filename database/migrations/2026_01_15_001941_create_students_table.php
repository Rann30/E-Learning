<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('nis')->unique();
            $table->string('class'); // Kelas: XII RPL 2
            $table->string('status')->default('Belum Lulus'); // Belum Lulus / Lulus
            $table->string('photo')->nullable();
            $table->integer('points')->default(0); // Poin pelanggaran
            $table->integer('badges')->default(0); // Jumlah badges
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
};