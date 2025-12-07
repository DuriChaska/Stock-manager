<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/inventario', [ProductoController::class, 'index'])->name('productos.index'); 
    Route::get('/inventario/crear', [ProductoController::class, 'create'])->name('productos.create');
    Route::post('/inventario', [ProductoController::class, 'store'])->name('productos.store');
});

require __DIR__.'/auth.php';
