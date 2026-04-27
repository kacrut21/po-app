<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\AuthController;

// Guest Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/profil', [\App\Http\Controllers\ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profil', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profil/password', [\App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password.update');

    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('/pesanan', [\App\Http\Controllers\OrderController::class, 'index'])->name('pesanan');

    Route::get('/laporan', [\App\Http\Controllers\ReportController::class, 'index'])->name('laporan');
    Route::get('/laporan/export', [\App\Http\Controllers\ReportController::class, 'exportExcel'])->name('laporan.export');

    Route::get('/form-po', [\App\Http\Controllers\OrderController::class, 'create'])->name('form-po');
    Route::post('/form-po', [\App\Http\Controllers\OrderController::class, 'store'])->name('form-po.store');
    Route::get('/form-po/{id}/edit', [\App\Http\Controllers\OrderController::class, 'edit'])->name('form-po.edit');
    Route::post('/form-po/{id}/update', [\App\Http\Controllers\OrderController::class, 'update'])->name('form-po.update');
    Route::match(['post','patch'], '/pesanan/{id}/status', [\App\Http\Controllers\OrderController::class, 'updateStatus'])->name('pesanan.status');
    Route::delete('/pesanan/{id}', [\App\Http\Controllers\OrderController::class, 'destroy'])->name('pesanan.destroy');
    Route::post('/pesanan/{id}/pembayaran', [\App\Http\Controllers\OrderController::class, 'updatePayment'])->name('pesanan.pembayaran');

    Route::get('/menu', [MenuController::class, 'index'])->name('menu');
    Route::post('/menu', [MenuController::class, 'store'])->name('menu.store');
    Route::delete('/menu/{id}', [MenuController::class, 'destroy'])->name('menu.destroy');
    Route::post('/menu/{id}/hpp', [MenuController::class, 'updateHpp'])->name('menu.hpp.update');
    Route::post('/menu/master-addons', [MenuController::class, 'updateMasterAddons'])->name('menu.addons.update');
    Route::post('/menu/master-addons/store', [MenuController::class, 'storeMasterAddon'])->name('menu.addons.store');
    Route::delete('/menu/master-addons/{id}', [MenuController::class, 'destroyMasterAddon'])->name('menu.addons.destroy');
});
