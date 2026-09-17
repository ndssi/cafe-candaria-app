<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * FIX: form tambah/edit menu punya field "Kategori" (Minuman/Makanan)
     * dan halaman daftar menu menampilkannya, tapi kolom ini tidak pernah
     * ada di tabel tbl_menu sehingga nilainya selalu hilang saat disimpan.
     */
    public function up(): void
    {
        Schema::table('tbl_menu', function (Blueprint $table) {
            $table->string('kategori', 20)->default('Minuman')->after('nama_menu');
        });
    }

    public function down(): void
    {
        Schema::table('tbl_menu', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
