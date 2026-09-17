<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_organigram', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('nama', 50);
            $table->string('jabatan', 50);
            $table->string('foto', 255)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_organigram');
    }
};