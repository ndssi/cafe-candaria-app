<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tbl_jam_operasional', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->string('hari', 50);
            $table->string('jam_buka', 20)->nullable();
            $table->string('jam_tutup', 20)->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tbl_jam_operasional');
    }
};
