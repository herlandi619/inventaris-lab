<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Laboran\AlatController;
use App\Http\Controllers\Laboran\DashboardLaboranController;
use App\Http\Controllers\Laboran\LaporanController;
use App\Http\Controllers\Laboran\MahasiswaController;
use App\Http\Controllers\Laboran\PeminjamanController;
use App\Http\Controllers\Mahasiswa\DashboardMahasiswaController;
use App\Http\Controllers\Mahasiswa\MahasiswaAlatController;
use App\Http\Controllers\Mahasiswa\MahasiswaPeminjamanController;
use App\Http\Controllers\Mahasiswa\MahasiswaScanController;
use App\Http\Controllers\Mahasiswa\ScanAlatController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//  LABORAN
Route::prefix('laboran')
    ->name('laboran.')
    ->middleware(['auth','role:laboran'])
    ->group(function () {

    //  DASHBOARD
    Route::get('/dashboard',[DashboardLaboranController::class,'index'])
        ->name('dashboard');

    // KELOLA ALAT
    Route::get('/', [AlatController::class,'index'])
        ->name('alat.index');

    Route::get('/create', [AlatController::class,'create'])
        ->name('alat.create');

    Route::post('/store', [AlatController::class,'store'])
        ->name('alat.store');

    Route::get('/edit/{id}', [AlatController::class,'edit'])
        ->name('alat.edit');

    Route::put('/update/{id}', [AlatController::class,'update'])
        ->name('alat.update');

    Route::delete('/delete/{id}', [AlatController::class,'destroy'])
        ->name('alat.delete');

    Route::get('/show/{kode}', [AlatController::class,'show'])
        ->name('alat.show');
    
    Route::get('/barcode/{kode}', [AlatController::class,'barcode'])
    ->name('alat.barcode');

    // KELOLA AKUN MAHASISWA
    Route::get('/mahasiswa',[MahasiswaController::class,'index'])->name('mahasiswa.index');

    Route::get('/mahasiswa/create',[MahasiswaController::class,'create'])->name('mahasiswa.create');

    Route::post('/mahasiswa/store',[MahasiswaController::class,'store'])->name('mahasiswa.store');

    Route::get('/mahasiswa/edit/{id}',[MahasiswaController::class,'edit'])->name('mahasiswa.edit');

    Route::put('/mahasiswa/update/{id}',[MahasiswaController::class,'update'])->name('mahasiswa.update');

    Route::delete('/mahasiswa/delete/{id}',[MahasiswaController::class,'destroy'])->name('mahasiswa.delete');

    Route::patch('/mahasiswa/{id}/aktifkan',[MahasiswaController::class,'aktifkan'])->name('mahasiswa.aktifkan');

    Route::patch('/mahasiswa/{id}/nonaktifkan',[MahasiswaController::class,'nonaktifkan'])->name('mahasiswa.nonaktifkan');


    // PEMINJAMAN ALAT
    Route::get('/peminjaman',[PeminjamanController::class,'index'])->name('peminjaman.index');

    Route::post('/peminjaman/{id}/setujui',[PeminjamanController::class,'setujui'])->name('peminjaman.setujui');

    Route::post('/peminjaman/{id}/tolak',[PeminjamanController::class,'tolak'])->name('peminjaman.tolak');

    Route::post('/peminjaman/{id}/dipinjam',[PeminjamanController::class,'dipinjam'])->name('peminjaman.dipinjam');


    // PENGEMBALIAN ALAT
    Route::get('/pengembalian', [PengembalianController::class,'index'])->name('pengembalian.index');
    
    Route::get('/pengembalian/create/{peminjaman}', [PengembalianController::class,'create'])->name('pengembalian.create');
    
    Route::post('/pengembalian', [PengembalianController::class,'store'])->name('pengembalian.store');


    // LAPORAN
    Route::get('/alat',[LaporanController::class,'alat'])
        ->name('laporan.alat');

    Route::get('/alat/export',[LaporanController::class,'exportAlat'])
        ->name('laporan.alat.export');

    Route::get('/laporanpeminjaman',[LaporanController::class,'peminjaman'])
        ->name('laporan.peminjaman');

    Route::get('/laporanpeminjaman/export',[LaporanController::class,'exportPeminjaman'])
        ->name('laporan.peminjaman.export');

    Route::get('/laporanpengembalian',[LaporanController::class,'pengembalian'])
        ->name('laporan.pengembalian');

    Route::get('/laporanpengembalian/export',[LaporanController::class,'exportPengembalian'])
        ->name('laporan.pengembalian.export');

});


//  MAHASISWA
Route::prefix('mahasiswa')
    ->name('mahasiswa.')
    ->middleware(['auth','role:mahasiswa'])
    ->group(function () {

    //  DASHBOARD
    Route::get('/dashboard',[DashboardMahasiswaController::class,'index'])
        ->name('dashboard');

    // DATA ALAT
    Route::get('/alatMahasiswa',[MahasiswaAlatController::class,'index'])->name('alat.index');

    Route::get('/alatMahasiswa/{kode}',[MahasiswaAlatController::class,'show'])->name('alat.show');
    
    Route::get('/scan', [MahasiswaAlatController::class,'scanQr'])->name('scan.qr');   


    // PEMINJAMAN
    Route::post('/peminjaman', [MahasiswaPeminjamanController::class, 'store'])
            ->name('peminjaman.store');

});

// global

Route::get('/show/{kode}', [AlatController::class,'showByQr'])
    ->name('alat.showByQr')
    ->middleware('auth'); // siapa pun yang login bisa akses

require __DIR__.'/auth.php';
