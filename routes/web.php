<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MovimientosController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rutas protegidas por login
Route::middleware('auth')->group(function () {

    // PERFIL
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/movimientos', [MovimientosController::class, 'index'])->name('movimientos.index');
    Route::get('/movimientos/entrada', [MovimientosController::class, 'create'])->name('movimientos.entrada');
    Route::get('/movimientos/salida', [MovimientosController::class, 'salida'])->name('movimientos.salida');
    Route::post('/movimientos', [MovimientosController::class, 'store'])->name('movimientos.store');
});

require __DIR__.'/auth.php';