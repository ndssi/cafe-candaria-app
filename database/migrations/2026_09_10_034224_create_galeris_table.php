<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_galeri', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('gambar', 255);
            $table->string('keterangan', 100);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_galeri');
    }
};