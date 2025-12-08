<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\MovimientosController;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ReportController; 


Route::get('/', function () {
    return redirect()->route('login');
});

    require __DIR__.'/auth.php';    
    Route::middleware(['auth', 'verified'])->group(function () {


    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('productos', ProductoController::class);
    Route::resource('proveedores', ProveedorController::class);
    Route::resource('usuarios', UserController::class);


    
    Route::get('reportes', [ReportController::class, 'index'])->name('reportes.index');
    Route::get('reportes/ventas-ingresos', [ReportController::class, 'ventasIngresos'])->name('reportes.ventas-ingresos');
    Route::get('reportes/ventas-marca', [ReportController::class, 'ventasPorMarca'])->name('reportes.ventas-marca');
    Route::get('reportes/productos-mas-vendidos', [ReportController::class, 'productosMasVendidos'])->name('reportes.productos-mas-vendidos');
    Route::get('reportes/evolucion-inventario', [ReportController::class, 'evolucionInventario'])->name('reportes.evolucion-inventario');



    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::get('/movimientos', [MovimientosController::class, 'index'])->name('movimientos.index');
    Route::get('/movimientos/entrada', [MovimientosController::class, 'entrada'])->name('movimientos.entrada');
    Route::post('/movimientos/store', [MovimientosController::class, 'store'])->name('movimientos.store');
    Route::get('/movimientos/salida', [MovimientosController::class, 'salida'])->name('movimientos.salida');

    
    Route::get('/productos/stock-bajo', function () {
        return redirect()->route('productos.index', ['filtro' => 'stock_bajo']);
    })->name('stock.bajo');

    Route::get('/ventas/hoy', function () {
        return redirect()->route('movimientos.index', ['fecha' => today()]);
    })->name('ventas.hoy');

});
