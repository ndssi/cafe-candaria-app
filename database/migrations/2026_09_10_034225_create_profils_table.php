<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_profil', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('judul', 100);
            $table->text('isi');
            $table->string('gambar', 255);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_profil');
    }
};