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
        Schema::create('soals', function (Blueprint $table) {
            $table->id('id_soal');
            $table->string('judul');
            $table->text('pertanyaan');
            $table->string('pilihan1');
            $table->string('pilihan2');
            $table->string('pilihan3');
            $table->string('pilihan4');
            $table->string('correct');
            $table->timestamps();

            $table->foreignId('fk_quiz')->references('id_quiz')->on('quizzes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soals');
    }
};
