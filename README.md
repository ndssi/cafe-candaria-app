# Cafe Candaria

Website profil dan katalog Cafe Candaria di SMKN 2 Purwakarta. Aplikasi ini menyediakan halaman publik untuk menampilkan profil, menu, jam operasional, struktur pengurus, dan galeri, serta panel admin untuk mengelola seluruh konten tersebut.

## Daftar Isi

- [Fitur](#fitur)
- [Teknologi](#teknologi)
- [Persyaratan](#persyaratan)
- [Instalasi](#instalasi)
- [Menjalankan Aplikasi](#menjalankan-aplikasi)
- [Akses Aplikasi](#akses-aplikasi)
- [Struktur Proyek](#struktur-proyek)
- [Pengelolaan Data](#pengelolaan-data)
- [Penyimpanan Gambar](#penyimpanan-gambar)
- [Pengujian](#pengujian)
- [Troubleshooting](#troubleshooting)
- [Catatan Produksi](#catatan-produksi)
- [Dokumentasi Arsitektur](#dokumentasi-arsitektur)

## Fitur

### Halaman publik

- Landing page Cafe Candaria pada `/`.
- Profil cafe dari database.
- Daftar menu dengan kategori, harga, deskripsi, dan gambar.
- Halaman seluruh menu pada `/detailmenu`.
- Jam operasional.
- Data organigram/pengurus.
- Galeri foto.
- Navigasi responsif untuk perangkat mobile.
- Pagination menu di browser ketika jumlah menu lebih dari enam item.

### Panel admin

- Login admin berbasis username dan password.
- Dashboard dengan ringkasan jumlah menu, galeri, dan pengurus.
- CRUD menu, galeri, dan organigram.
- Edit profil dan jam operasional.
- Validasi input dan upload gambar.
- Penghapusan file gambar lama ketika data diganti atau dihapus.

## Teknologi

- PHP `^8.1`
- Laravel `^10.10`
- Laravel Sanctum `^3.3` untuk fondasi autentikasi API
- MySQL atau database yang kompatibel dengan konfigurasi Laravel
- Blade untuk server-side rendering
- Vite `^5.0` dan `laravel-vite-plugin`
- Axios untuk kebutuhan JavaScript
- PHPUnit `^10.1` dan Laravel Pint

Asset halaman publik dan admin berada di `public/css`, `public/js`, dan `public/images`. Vite juga dikonfigurasi untuk `resources/css/app.css` dan `resources/js/app.js`.

## Persyaratan

- PHP 8.1 atau lebih baru.
- Composer.
- Node.js dan npm.
- MySQL/MariaDB yang aktif.
- PHP extension umum Laravel seperti PDO MySQL, Mbstring, OpenSSL, Tokenizer, XML, Ctype, JSON, dan Fileinfo.

Pada Windows dengan Laragon, project dapat diletakkan di `C:\laragon\www\cafe-candaria` dan database dijalankan melalui MySQL bawaan Laragon.

## Instalasi

Jalankan dari root project:

```bash
composer install
npm install
copy .env.example .env
php artisan key:generate
```

Sesuaikan koneksi database di `.env`:

```dotenv
APP_NAME="Cafe Candaria"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cafe_candaria
DB_USERNAME=root
DB_PASSWORD=
```

Buat database `cafe_candaria` di MySQL, lalu jalankan migration dan seeder:

```bash
php artisan migrate --seed
php artisan storage:link
```

`migrate:fresh --seed` akan menghapus seluruh tabel dan data. Gunakan hanya untuk database development.

## Menjalankan Aplikasi

### Mode development

```bash
php artisan serve
```

Pada terminal lain, jalankan Vite saat mengembangkan asset dari `resources`:

```bash
npm run dev
```

Buka `http://127.0.0.1:8000` atau URL yang ditampilkan oleh Artisan.

### Build asset

```bash
npm run build
```

### Laragon

Jika menggunakan virtual host Laragon, arahkan document root ke folder `public`, bukan ke root repository. Pastikan Apache/Nginx dan MySQL aktif.

## Akses Aplikasi

| Kebutuhan | URL | Keterangan |
| --- | --- | --- |
| Halaman publik | `/` | Profil, menu, jadwal, organigram, dan galeri |
| Seluruh menu | `/detailmenu` | Daftar menu lengkap |
| Login admin | `/admin/login` | Form login panel admin |
| Dashboard admin | `/admin/dashboard` | Membutuhkan session admin |

Seeder development membuat akun awal:

```text
Username: admin
Password: admin123
```

Segera ganti password tersebut sebelum aplikasi digunakan di lingkungan yang dapat diakses pengguna lain. Saat ini belum tersedia halaman ganti password, sehingga perubahan perlu dilakukan melalui database atau fitur tambahan.

## Struktur Proyek

```text
app/
  Http/Controllers/Admin/   Controller login dan pengelolaan konten admin
  Http/Middleware/          Middleware admin.auth
  Models/                   Model Eloquent untuk tabel tbl_*
database/
  migrations/               Definisi tabel dan perubahan schema
  seeders/                  Data awal aplikasi
public/
  css/ js/ images/          Asset statis
  storage                  Symbolic link ke storage/app/public
resources/views/            Template Blade publik dan admin
routes/
  web.php                   Route publik dan panel admin
  api.php                   Endpoint API bawaan Sanctum
storage/app/public/         File gambar hasil upload
tests/                      Feature test dan unit test PHPUnit
```

Penjelasan alur dan batas antar komponen tersedia di [ARCHITECTURE.md](ARCHITECTURE.md).

## Pengelolaan Data

| Modul | Model | Tabel | Operasi admin |
| --- | --- | --- | --- |
| Profil | `Profil` | `tbl_profil` | Satu profil aktif, edit judul/sejarah/foto |
| Menu | `Menu` | `tbl_menu` | Tambah, lihat, edit, hapus |
| Galeri | `Galeri` | `tbl_galeri` | Tambah, lihat, edit, hapus |
| Organigram | `Organigram` | `tbl_organigram` | Tambah, lihat, edit, hapus |
| Jam operasional | `JamOperasional` | `tbl_jam_operasional` | Lihat, edit, hapus |
| Admin | `AdminUser` | `tbl_user` | Validasi login |

Semua tabel domain tidak memiliki `created_at` dan `updated_at`, sehingga model terkait menetapkan `$timestamps = false`.

Kategori menu dibatasi ke `Makanan` atau `Minuman`. Upload gambar menerima JPEG, PNG, JPG, GIF, SVG, dan WebP dengan ukuran maksimal 5 MB.

## Penyimpanan Gambar

Controller menyimpan upload pada disk Laravel `public`:

| Jenis data | Folder |
| --- | --- |
| Profil | `storage/app/public/profil` |
| Menu | `storage/app/public/menu` |
| Galeri | `storage/app/public/galeri` |
| Organigram | `storage/app/public/organigram` |

Kolom database menyimpan path relatif, misalnya `menu/nama-file.jpg`. View membentuk URL melalui `asset('storage/' . $path)`. Karena itu `php artisan storage:link` wajib dijalankan pada instalasi baru.

Saat gambar diganti atau data dihapus, controller mencoba menghapus file lama dari disk `public`.

## Pengujian

```bash
php artisan test
```

Test yang tersedia saat ini mencakup feature test bahwa `/` mengembalikan HTTP 200 dan unit test assertion dasar. Untuk perubahan autentikasi, CRUD, upload, dan middleware, tambahkan feature test yang memakai database pengujian.

## Troubleshooting

### Error koneksi database

Periksa `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`, dan status MySQL. Setelah mengubah konfigurasi:

```bash
php artisan config:clear
php artisan cache:clear
```

### Gambar upload tidak tampil

Jalankan `php artisan storage:link`, lalu periksa file di `storage/app/public` dan path pada kolom gambar.

### Route admin selalu mengarah ke login

Middleware `admin.auth` memeriksa session `admin_id`. Login melalui `/admin/login` dan pastikan session driver dapat menulis ke `storage/framework/sessions`.

### Asset tidak berubah

Jalankan `npm run dev` saat development atau `npm run build` untuk asset production. Refresh cache browser bila diperlukan.

## Catatan Produksi

- Set `APP_ENV=production` dan `APP_DEBUG=false`.
- Gunakan `APP_KEY` yang kuat dan jangan commit `.env`.
- Ganti kredensial admin bawaan.
- Gunakan HTTPS untuk login dan session.
- Backup database serta `storage/app/public` secara berkala.
- Pastikan web server menunjuk ke folder `public`.
- Jalankan `php artisan optimize` setelah konfigurasi production siap.
- Review route API sebelum mengekspos endpoint baru. `routes/api.php` saat ini hanya berisi `/api/user` yang dilindungi `auth:sanctum`.

## Dokumentasi Arsitektur

Dokumentasi teknis lengkap mengenai komponen, aliran request, model data, autentikasi, dan keputusan implementasi tersedia di [ARCHITECTURE.md](ARCHITECTURE.md).

## Lisensi

Project ini menggunakan Laravel sebagai framework dengan lisensi MIT. Lisensi aplikasi dapat ditetapkan oleh pemilik project sesuai kebutuhan distribusi dan deployment.
