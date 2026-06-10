<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HajjStatController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('home');
Route::get('/berita', [NewsController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [NewsController::class, 'show'])->name('berita.show');

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
        Route::resource('berita', AdminNewsController::class)->except(['show']);
        Route::get('data-jemaah', [HajjStatController::class, 'edit'])->name('hajj-stats.edit');
        Route::put('data-jemaah', [HajjStatController::class, 'update'])->name('hajj-stats.update');
    });
});
