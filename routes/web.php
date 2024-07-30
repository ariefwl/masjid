<?php

use App\Http\Controllers\Backend\DashboardController as BackendDashboardController;
use App\Http\Controllers\Backend\KelompokController;
use App\Http\Controllers\Backend\ProfileController as BackendProfileController;
use App\Http\Controllers\Backend\UPQ\HewanController;
use App\Http\Controllers\Backend\UPQ\kasQurbanController;
use App\Http\Controllers\Backend\UPQ\PenerimaController;
use App\Http\Controllers\Backend\UPQ\ShohibulController;
use App\Http\Controllers\Backend\UPZ\ZakatController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Reverb\Servers\Reverb\Http\Route as HttpRoute;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;


Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');
Route::get('/shohibulDetail', [DashboardController::class, 'shohibulDetail']);
Route::get('/groupSapi', [DashboardController::class, 'groupSapi']);
Route::get('/groupKambing', [DashboardController::class, 'groupKambing']);
Route::get('/kel', [DashboardController::class, 'kelompok']);
Route::get('/warga', [DashboardController::class, 'warga'])->name('dashboard.warga');

Route::get('/dashboard', [BackendDashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth', 'AdminUPQ')->group(function(){
    Route::get('/penerima/exportExcel', [PenerimaController::class, 'export_excel'])->name('exportExcel');
    Route::post('/penerima/importData', [PenerimaController::class, 'importData'])->name('importData');
    Route::resource('penerima', PenerimaController::class);
    Route::resource('shohibul', ShohibulController::class);
    Route::get('shohibul/cetakUndangan', [ShohibulController::class, 'cetakUndangan'])->name('cetakUndangan');
    Route::resource('hewan', HewanController::class);
    Route::resource('kasQurban', kasQurbanController::class);

    Route::get('saldoKas', [kasQurbanController::class, 'getSaldoAkhir']);
    Route::get('dashboard/getSaldoKasQurban', [BackendDashboardController::class, 'getSaldoKasQurban']);
    Route::get('dashboard/getRevenue', [BackendDashboardController::class, 'getRevenue']);
    Route::get('dashboard/getExpense', [BackendDashboardController::class, 'getExpense']);
    Route::get('CetakLaporan/{tgl_awal}/{tgl_akhir}', [kasQurbanController::class, 'cetakLap']);
});

Route::middleware('auth', 'AdminUPZ')->group(function(){
    
});

Route::middleware('auth')->group(function () {
    // Route::get('/kelompok', [KelompokController::class, 'index'])->name('kelompok');
    Route::resource('kelompok', KelompokController::class);
    Route::resource('profiles', BackendProfileController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/zakat', ZakatController::class);
});

require __DIR__.'/auth.php';
