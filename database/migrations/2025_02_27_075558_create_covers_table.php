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
        Schema::create('covers', function (Blueprint $table) {
            $table->id('id_cover');
            $table->string('judul');
            $table->string('kategori');
            $table->string('thumbnail');
            $table->text('deskripsi');
            $table->string('mentor');
            $table->foreignId('fk_mentor')->constrained('mentors', 'id_mentor')->onDelete('cascade');

            $table->foreignId('fk_jurusan')->constrained('jurusans', 'id_jurusan')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('covers');
    }
};
