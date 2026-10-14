<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HajjStatController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\OfficeProfileController as AdminOfficeProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\OfficeProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServiceController as PublicServiceController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/profil', [OfficeProfileController::class, 'index'])->name('profil');
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/create', fn () => redirect()->route('admin.berita.create'));
Route::get('/berita/tambah', fn () => redirect()->route('admin.berita.create'));
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');
Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
Route::get('/layanan/{slug}', [PublicServiceController::class, 'show'])->name('layanan.show');

// Public Info Jemaah 2027
Route::get('/info-jemaah-2027', [\App\Http\Controllers\Hajj2027Controller::class, 'index'])->name('info.jemaah.2027');
Route::get('/info-jemaah-2027/dokumen/{document}/download', [\App\Http\Controllers\Hajj2027Controller::class, 'downloadDocument'])->name('info.jemaah.2027.download');
Route::get('/info-jemaah-2027/pengumuman/{slug}', [\App\Http\Controllers\Hajj2027Controller::class, 'showAnnouncement'])->name('info.jemaah.2027.pengumuman');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AuthController::class, 'showLogin'])->name('login');
        Route::post('login', [AuthController::class, 'login'])->name('login.submit');
    });

    Route::middleware('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::get('konten', [ContentController::class, 'edit'])->name('content.edit');
        Route::put('konten', [ContentController::class, 'update'])->name('content.update');
        Route::resource('layanan', ServiceController::class)
            ->parameters(['layanan' => 'layanan'])
            ->except(['show']);
        Route::get('berita/tambah', fn () => redirect()->route('admin.berita.create'));
        Route::resource('berita', AdminNewsController::class)->except(['show']);
        Route::resource('profil', AdminOfficeProfileController::class)->except(['show']);
        Route::resource('pejabat', App\Http\Controllers\Admin\OfficialController::class)
            ->parameters(['pejabat' => 'official'])
            ->except(['show']);
        Route::resource('galeri', AdminGalleryController::class)->except(['show']);
        Route::get('data-jemaah', [HajjStatController::class, 'edit'])->name('hajj-stats.edit');
        Route::put('data-jemaah', [HajjStatController::class, 'update'])->name('hajj-stats.update');

        // 🕋 Info Jemaah 2027 Admin Management
        Route::prefix('info-jemaah-2027')->name('jemaah-2027.')->group(function () {
            Route::get('/', [\App\Http\Controllers\Admin\Hajj2027\DashboardController::class, 'index'])->name('dashboard');
            Route::get('statistik', [\App\Http\Controllers\Admin\Hajj2027\StatController::class, 'edit'])->name('stats.edit');
            Route::put('statistik', [\App\Http\Controllers\Admin\Hajj2027\StatController::class, 'update'])->name('stats.update');
            Route::resource('progres', \App\Http\Controllers\Admin\Hajj2027\StageController::class)
                ->parameters(['progres' => 'stage'])
                ->names('stages')
                ->except(['show']);
            Route::resource('verifikasi', \App\Http\Controllers\Admin\Hajj2027\VerificationController::class)
                ->parameters(['verifikasi' => 'verification'])
                ->names('verifications')
                ->except(['show']);
            Route::get('biometrik', [\App\Http\Controllers\Admin\Hajj2027\BiometricController::class, 'edit'])->name('biometrics.edit');
            Route::put('biometrik', [\App\Http\Controllers\Admin\Hajj2027\BiometricController::class, 'update'])->name('biometrics.update');
            Route::resource('kecamatan', \App\Http\Controllers\Admin\Hajj2027\DistrictController::class)
                ->parameters(['kecamatan' => 'district'])
                ->names('districts')
                ->except(['show']);
            Route::resource('timeline', \App\Http\Controllers\Admin\Hajj2027\TimelineController::class)
                ->parameters(['timeline' => 'timeline'])
                ->names('timelines')
                ->except(['show']);
            Route::resource('kloter', \App\Http\Controllers\Admin\Hajj2027\KloterController::class)
                ->parameters(['kloter' => 'kloter'])
                ->names('kloters')
                ->except(['show']);
            Route::resource('pengumuman', \App\Http\Controllers\Admin\Hajj2027\AnnouncementController::class)
                ->parameters(['pengumuman' => 'announcement'])
                ->names('announcements')
                ->except(['show']);
            Route::resource('dokumen', \App\Http\Controllers\Admin\Hajj2027\DocumentController::class)
                ->parameters(['dokumen' => 'document'])
                ->names('documents')
                ->except(['show']);
            Route::resource('layanan', \App\Http\Controllers\Admin\Hajj2027\ServiceController::class)
                ->parameters(['layanan' => 'service'])
                ->names('services')
                ->except(['show']);
        });
    });
});
