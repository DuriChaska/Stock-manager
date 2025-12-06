<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 
use App\Http\Controllers\ReportController; 



Route::resource('usuarios', UserController::class);



Route::get('reportes', [ReportController::class, 'index'])->name('reportes.index');
Route::get('reportes/ventas-ingresos', [ReportController::class, 'ventasIngresos'])->name('reportes.ventas-ingresos');
Route::get('reportes/ventas-marca', [ReportController::class, 'ventasPorMarca'])->name('reportes.ventas-marca');
Route::get('reportes/productos-mas-vendidos', [ReportController::class, 'productosMasVendidos'])->name('reportes.productos-mas-vendidos');
Route::get('reportes/evolucion-inventario', [ReportController::class, 'evolucionInventario'])->name('reportes.evolucion-inventario');

