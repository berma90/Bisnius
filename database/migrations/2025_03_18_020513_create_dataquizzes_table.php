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
        Schema::create('dataquizzes', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_correct')->default(0);
            $table->string('Jawaban');
            $table->integer('score');
            $table->foreignId('fk_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('fk_quiz')->constrained('quizzes')->onDelete('cascade');
            $table->foreignId('fk_soal')->constrained('soals')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dataquizzes');
    }
};
