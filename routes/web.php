<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ProfilController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\OrganigramController;
use App\Http\Controllers\Admin\JamOperasionalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ROUTE HALAMAN PUBLIK
// FIX: sebelumnya halaman beranda 100% statis (menu, jam operasional,
// organigram, galeri semua hardcoded), jadi perubahan dari admin panel
// tidak pernah tampil ke pengunjung. Sekarang datanya diambil dari DB.
Route::get('/', function () {
    return view('beranda', [
        'profil'          => \App\Models\Profil::first(),
        'menus'           => \App\Models\Menu::all(),
        'jam_operasional' => \App\Models\JamOperasional::all(),
        'organigrams'     => \App\Models\Organigram::all(),
        'galleries'       => \App\Models\Galeri::all(),
    ]);
})->name('beranda');

Route::get('/detailmenu', function () {
    return view('detailmenu', ['menus' => \App\Models\Menu::all()]);
})->name('detailmenu');

Route::get('/tentang-kami', function () {
    return view('tentang-kami');
})->name('tentang-kami');

// ROUTE AUTH / LOGIN / LOGOUT
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// ROUTE ADMIN (WAJIB LOGIN)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('admin.dashboard', [
            'totalMenu'       => \App\Models\Menu::count(),
            'totalGaleri'     => \App\Models\Galeri::count(),
            'totalOrganigram' => \App\Models\Organigram::count(),
        ]);
    })->name('dashboard');

    // PROFIL
    Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
    Route::get('/editprofil', [ProfilController::class, 'edit'])->name('editprofil');
    Route::put('/profil/update', [ProfilController::class, 'update'])->name('profil.update');
    Route::delete('/profil/delete-judul', [ProfilController::class, 'deleteJudul'])->name('profil.delete-judul');
    Route::delete('/profil/delete-sejarah', [ProfilController::class, 'deleteSejarah'])->name('profil.delete-sejarah');

    // MENU
    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::get('/menu/create', [MenuController::class, 'create'])->name('menu.create');
    Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
    Route::get('/menu/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
    Route::put('/menu/update/{id}', [MenuController::class, 'update'])->name('menu.update');
    Route::get('/menu/delete/{id}', [MenuController::class, 'destroyConfirm'])->name('menu.delete');
    Route::delete('/menu/destroy/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');

    // GALERI
    Route::get('/galeri', [GaleriController::class, 'index'])->name('galeri');
    Route::get('/galeri/create', [GaleriController::class, 'create'])->name('galeri.create');
    Route::post('/galeri/store', [GaleriController::class, 'store'])->name('galeri.store');
    Route::get('/galeri/edit/{id}', [GaleriController::class, 'edit'])->name('galeri.edit');
    Route::put('/galeri/update/{id}', [GaleriController::class, 'update'])->name('galeri.update');
    Route::get('/galeri/hapus/{id}', [GaleriController::class, 'destroyConfirm'])->name('galeri.hapus');
    Route::delete('/galeri/destroy/{id}', [GaleriController::class, 'destroy'])->name('galeri.destroy');

    // ORGANIGRAM
    Route::get('/organigram', [OrganigramController::class, 'index'])->name('organigram');
    Route::get('/organigram/tambah', [OrganigramController::class, 'create'])->name('organigram.tambah');
    Route::post('/organigram/store', [OrganigramController::class, 'store'])->name('organigram.store');
    Route::get('/organigram/edit/{id}', [OrganigramController::class, 'edit'])->name('organigram.edit');
    Route::put('/organigram/update/{id}', [OrganigramController::class, 'update'])->name('organigram.update');
    Route::get('/organigram/hapus/{id}', [OrganigramController::class, 'destroyConfirm'])->name('organigram.hapus');
    Route::delete('/organigram/destroy/{id}', [OrganigramController::class, 'destroy'])->name('organigram.destroy');

    // JAM OPERASIONAL
    Route::get('/jam-operasional', [JamOperasionalController::class, 'index'])->name('jam-operasional');
    Route::get('/jam-operasional/edit/{id}', [JamOperasionalController::class, 'edit'])->name('jam-operasional.edit');
    Route::put('/jam-operasional/update/{id}', [JamOperasionalController::class, 'update'])->name('jam-operasional.update');
    Route::get('/jam-operasional/delete/{id}', [JamOperasionalController::class, 'destroyConfirm'])->name('jam-operasional.delete');
    Route::delete('/jam-operasional/destroy/{id}', [JamOperasionalController::class, 'destroy'])->name('jam-operasional.destroy');
});
