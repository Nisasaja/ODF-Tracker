<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EdukasiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenerimaController;
use App\Http\Controllers\ProfileController;
use App\Models\Edukasi;
use Illuminate\Support\Facades\Route;


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

Route::get('/', function () {
    return view('welcome');
});


Route::middleware('auth')->group(function()  {
    Route::resource('edukasis', EdukasiController::class);
    Route::resource('edukasi', EdukasiController::class);
    Route::resource('laporans', LaporanController::class);
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/penerimas/create', [PenerimaController::class, 'create'])->middleware('role:admin,petugas_lapangan');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'delete'])->name('profile.delete');
    Route::resource('laporans', LaporanController::class)->only(['index', 'show']);
    Route::get('/laporans/create', [LaporanController::class, 'create'])->name('laporans.create');
    Route::resource('penerimas', PenerimaController::class)->only(['index', 'show']);
    Route::resource('laporans', LaporanController::class)->middleware('auth');
    Route::get('penerimas/download', [PenerimaController::class, 'download'])->name('penerimas.download');
    Route::get('laporans/download', [LaporanController::class, 'download'])->name('laporans.download');
}); 

Route::middleware(['auth', 'role:admin, field-officer'])->group(function() {
    Route::resource('laporans',LaporanController::class)->except(['index', 'show']);
    Route::resource('penerimas', PenerimaController::class)->except(['index', 'show']);
});


require __DIR__.'/auth.php';
    