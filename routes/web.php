<?php

use App\Http\Controllers\Laboran\AlatController;
use App\Http\Controllers\Laboran\DashboardLaboranController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//  LABORAN
Route::prefix('laboran')
    ->name('laboran.')
    ->middleware(['auth'])
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
});


require __DIR__.'/auth.php';
