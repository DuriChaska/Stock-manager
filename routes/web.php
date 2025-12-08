<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;

use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MovimientosController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return redirect()->route('login');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('productos', ProductoController::class);
    
    Route::resource('proveedores', ProveedorController::class);
    
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Movimientos personalizados
    Route::get('/movimientos', [MovimientosController::class, 'index'])->name('movimientos.index');
    Route::get('/movimientos/entrada', [MovimientosController::class, 'entrada'])->name('movimientos.entrada');
    Route::post('/movimientos/store', [MovimientosController::class, 'store'])->name('movimientos.store');
    Route::get('/movimientos/salida', [MovimientosController::class, 'salida'])->name('movimientos.salida');

    // Filtros
    Route::get('/productos/stock-bajo', function () {
        return redirect()->route('productos.index', ['filtro' => 'stock_bajo']);
    })->name('stock.bajo');

    Route::get('/ventas/hoy', function () {
        return redirect()->route('movimientos.index', ['fecha' => today()]);
    })->name('ventas.hoy');
});


