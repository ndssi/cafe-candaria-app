<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * FITUR BARU: input foto untuk menu, supaya foto yang diupload admin
     * bisa ditampilkan di halaman menu publik (beranda & detail menu).
     */
    public function up(): void
    {
        Schema::table('tbl_menu', function (Blueprint $table) {
            $table->string('gambar', 255)->nullable()->after('kategori');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_menu', function (Blueprint $table) {
            $table->dropColumn('gambar');
        });
    }
};
