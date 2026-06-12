<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MagangController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

// Halaman Home (Menampilkan statistik prodi)
Route::get('/', [PortalController::class, 'index'])->name('home');

// Halaman Daftar Lowongan Magang
Route::get('/portal', [PortalController::class, 'portal'])->name('portal');

// Halaman Detail Lowongan Magang
Route::get('/portal/detail/{id}', [PortalController::class, 'detail'])
    ->whereNumber('id')
    ->name('portal.detail');

// --- ROUTE AUTH ADMIN (URL RAHASIA) ---
Route::get('/panel-internal-bemft', [AuthController::class, 'showLogin'])->name('login');
Route::post('/panel-internal-bemft', [AuthController::class, 'login'])
    ->middleware('throttle:5,1')
    ->name('login.store');

Route::middleware('auth')->group(function () {
    Route::post('/admin/logout', [AuthController::class, 'logout'])->name('logout');
});

// --- ROUTE DASHBOARD ADMIN (PROTECTED) ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/magang', [MagangController::class, 'index'])->name('magang.index');
    Route::post('/magang', [MagangController::class, 'store'])->name('magang.store');
    Route::get('/magang/{id}/edit', [MagangController::class, 'edit'])
        ->whereNumber('id')
        ->name('magang.edit');
    Route::put('/magang/{id}', [MagangController::class, 'update'])
        ->whereNumber('id')
        ->name('magang.update');
    Route::delete('/magang/{id}', [MagangController::class, 'destroy'])
        ->whereNumber('id')
        ->name('magang.destroy');
});
