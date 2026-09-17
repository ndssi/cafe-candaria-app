<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_menu', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama_menu', 100);
            $table->text('deskripsi');
            $table->string('harga', 20);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_menu');
    }
};