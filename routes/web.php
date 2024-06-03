<?php

use App\Http\Controllers\Backend\KelompokController;
use App\Http\Controllers\Backend\UPQ\PenerimaController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'AdminUPQ')->group(function(){
    Route::get('/penerima/exportExcel', [PenerimaController::class, 'export_excel'])->name('exportExcel');
    Route::post('/penerima/importData', [PenerimaController::class, 'importData'])->name('importData');
    Route::resource('penerima', PenerimaController::class);
});

Route::middleware('auth', 'AdminUPZ')->group(function(){
    
});

Route::middleware('auth')->group(function () {
    Route::get('/kelompok', [KelompokController::class, 'index'])->name('kelompok');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
