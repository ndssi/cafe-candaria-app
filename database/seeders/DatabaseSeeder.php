<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\JamOperasional;
use App\Models\Menu;
use App\Models\Profil;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * FIX: sebelumnya method run() ini dikomentari semua sehingga
     * `php artisan db:seed` tidak melakukan apa pun — tidak pernah
     * ada akun admin default untuk login.
     */
    public function run(): void
    {
        // Akun admin bawaan (username: admin / password: admin123)
        if (!AdminUser::where('username', 'admin')->exists()) {
            AdminUser::create([
                'nama'     => 'Admin Cafe Candaria',
                'username' => 'admin',
                'password' => Hash::make('admin123'),
            ]);
        }

        // Data profil cafe default (judul, sejarah, foto bisa diedit lewat admin)
        if (Profil::count() === 0) {
            Profil::create([
                'judul'  => 'CAFE CANDARIA SMKN 2 PURWAKARTA',
                'isi'    => 'Cafe Candaria berawal dari kebutuhan siswa dan guru SMKN 2 Purwakarta akan tempat istirahat yang nyaman dengan menu yang enak dan terjangkau. Dari sinilah ide untuk menghadirkan kantin sekolah dengan konsep cafe modern muncul, memadukan pelayanan ramah dengan suasana yang hangat untuk mendukung aktivitas belajar sehari-hari.',
                'gambar' => '',
            ]);
        }

        // Jadwal jam operasional default
        if (JamOperasional::count() === 0) {
            JamOperasional::insert([
                ['hari' => 'Senin - Jumat', 'jam_buka' => '07.00', 'jam_tutup' => '14.00'],
                ['hari' => 'Sabtu', 'jam_buka' => '-', 'jam_tutup' => '-'],
                ['hari' => 'Minggu', 'jam_buka' => '-', 'jam_tutup' => '-'],
            ]);
        }

        // Beberapa menu contoh supaya halaman tidak kosong saat pertama dibuka
        if (Menu::count() === 0) {
            Menu::insert([
                ['nama_menu' => 'Es Tea Jus', 'kategori' => 'Minuman', 'deskripsi' => '', 'harga' => '2.000'],
                ['nama_menu' => 'Dimsum', 'kategori' => 'Makanan', 'deskripsi' => '', 'harga' => '7.000'],
                ['nama_menu' => 'Es Bonteh', 'kategori' => 'Minuman', 'deskripsi' => '', 'harga' => '4.000'],
                ['nama_menu' => 'Pisang Crispy', 'kategori' => 'Makanan', 'deskripsi' => '', 'harga' => '4.000'],
            ]);
        }
    }
}
