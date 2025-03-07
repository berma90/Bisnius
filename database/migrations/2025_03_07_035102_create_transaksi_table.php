<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('kd_order')->unique();
            $table->dateTime('tanggal_beli')->nullable();
            $table->dateTime('tanggal_tenggat')->nullable();
            $table->string('paket'); // 7 Days, 3 Months, 1 Year
            $table->integer('harga'); // Harga paket
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('transaksi');
    }
};

