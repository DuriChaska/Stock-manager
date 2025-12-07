<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\MovimientoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('productos', ProductoController::class);
    Route::resource('movimientos', MovimientoController::class);
    Route::resource('proveedores', ProveedorController::class);

    // Perfil usuario
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Atajos de navegación
    Route::get('/productos/stock-bajo', function () {
        return redirect()->route('productos.index', ['filtro' => 'stock_bajo']);
    })->name('stock.bajo');

    Route::get('/ventas/hoy', function () {
        return redirect()->route('movimientos.index', ['fecha' => today()]);
    })->name('ventas.hoy');
});

// Rutas de autenticación Breeze/Fortify
require __DIR__.'/auth.php';
