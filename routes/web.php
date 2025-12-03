<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\PublikasiController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\StatistikController;
use App\Models\Berita;

// Halaman Depan (Beranda)
Route::get('/', function () {
    $beritaTerbaru = Berita::with('user')
        ->where('status', 'published')
        ->latest()
        ->take(3)
        ->get();

    $statistik = (new StatistikController)->getStatistik();

    return view('welcome', compact('beritaTerbaru', 'statistik'));
});

// Halaman Publikasi
Route::get('/publikasi', [PublikasiController::class, 'index'])->name('publikasi.index');

// Halaman Detail Berita
Route::get('/berita/{berita:slug}', function (Berita $berita) {
    if ($berita->status !== 'published') {
        abort(404);
    }
    return view('berita-show', compact('berita'));
})->name('berita.show');

// =========================================================================
// GROUP ADMIN: Settings & Statistik
// =========================================================================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    
    // ---- SETTINGS WEBSITE ----
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    
    // --- Hero Background Routes ---
    Route::post('/settings/hero-background', [SettingController::class, 'updateHeroBackground'])->name('settings.hero-background');
    Route::delete('/settings/hero-background/all', [SettingController::class, 'deleteAllHeroBackgrounds'])->name('settings.hero-background.delete-all');
    Route::delete('/settings/hero-background/{id}', [SettingController::class, 'deleteHeroBackground'])->name('settings.hero-background.delete');
    
    // --- Site Logo Routes ---
    Route::post('/settings/site-logo', [SettingController::class, 'updateSiteLogo'])->name('settings.site-logo');
    Route::delete('/settings/site-logo', [SettingController::class, 'deleteSiteLogo'])->name('settings.site-logo.delete');
    
    // --- Hero Text Routes ---
    Route::post('/settings/hero-text', [SettingController::class, 'updateHeroText'])->name('settings.hero-text');

    // --- BPD Structure Routes (BARU) ---
    Route::post('/settings/bpd-structure', [SettingController::class, 'updateBpdStructure'])->name('settings.bpd-structure');
    Route::delete('/settings/bpd-structure', [SettingController::class, 'deleteBpdStructure'])->name('settings.bpd-structure.delete');

    // profile desa
    Route::post('/settings/profil-desa-image', [SettingController::class, 'updateProfilDesaImage'])->name('settings.profil-desa-image');
    Route::delete('/settings/profil-desa-image', [SettingController::class, 'deleteProfilDesaImage'])->name('settings.profil-desa-image.delete');
    Route::post('/settings/profil-desa-text', [SettingController::class, 'updateProfilDesaText'])->name('settings.profil-desa-text');

    // --- Struktur Organisasi Routes ---
    Route::post('/settings/struktur-organisasi', [SettingController::class, 'updateStrukturOrganisasi'])->name('settings.struktur-organisasi');
    Route::delete('/settings/struktur-organisasi', [SettingController::class, 'deleteStrukturOrganisasi'])->name('settings.struktur-organisasi.delete');

    // --- Statistik Desa ---
    Route::get('/statistik', [StatistikController::class, 'index'])->name('statistik.index');
    Route::put('/statistik', [StatistikController::class, 'update'])->name('statistik.update');

    // --- Visi & Misi Routes ---
    Route::post('/settings/visi-misi', [SettingController::class, 'updateVisiMisi'])->name('settings.visi-misi');
});

// =========================================================================
// GROUP AUTH: Dashboard, Profile, Resource Management
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Profile Management
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Dashboard & Resources
    Route::prefix('admin')->name('admin.')->group(function () {
        
        Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');

        Route::resource('users', UserController::class)->middleware('role:admin');
        
        // Resource Berita untuk CRUD Admin
        Route::resource('berita', BeritaController::class)->parameters([
            'berita' => 'berita'
        ]);
        
        Route::post('/berita/upload', [BeritaController::class, 'upload'])->name('berita.upload');
    });
});

require __DIR__.'/auth.php';