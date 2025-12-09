<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\InventarioController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\MovimientosController;
use Illuminate\Support\Facades\Auth;


// ---------------------------------------------------------------------
// Redirigir raíz a login
// ---------------------------------------------------------------------
Route::get('/', function () {
    return redirect()->route('login');
});


// ---------------------------------------------------------------------
// Dashboard principal
// ---------------------------------------------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


// ---------------------------------------------------------------------
// Rutas protegidas por autenticación
// ---------------------------------------------------------------------
Route::middleware(['auth'])->group(function () {

    // -------------------------------------------------------
    // NOTIFICACIONES
    // -------------------------------------------------------
    Route::get('/notificaciones/leer', function () {
        Auth::user()->unreadNotifications->markAsRead();
        return response()->json(['ok' => true]);
    })->name('notificaciones.leer');


    // -------------------------------------------------------
    // PERFIL
    // -------------------------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // -------------------------------------------------------
    // INVENTARIO
    // -------------------------------------------------------
    Route::get('/inventario',               [InventarioController::class, 'index'])->name('inventario.index');
    Route::get('/inventario/create',        [InventarioController::class, 'create'])->name('inventario.create');
    Route::post('/inventario/store',        [InventarioController::class, 'store'])->name('inventario.store');
    Route::get('/inventario/{id}/edit',     [InventarioController::class, 'edit'])->name('inventario.edit');
    Route::put('/inventario/{id}',          [InventarioController::class, 'update'])->name('inventario.update');
    Route::delete('/inventario/{id}',       [InventarioController::class, 'destroy'])->name('inventario.destroy');
    Route::get('/inventario/{id}',          [InventarioController::class, 'show'])->name('inventario.show');


    // -------------------------------------------------------
    // REDIRECCIÓN DE PRODUCTOS A INVENTARIO
    // -------------------------------------------------------
    Route::get('/productos', function () {
        return redirect()->route('inventario.index');
    });


    // -------------------------------------------------------
    // PROVEEDORES
    // -------------------------------------------------------
    Route::resource('proveedores', ProveedorController::class);


    // -------------------------------------------------------
    // USUARIOS
    // -------------------------------------------------------
    Route::resource('usuarios', UserController::class);


    // -------------------------------------------------------
    // REPORTES
    // -------------------------------------------------------
    Route::get('reportes',                        [ReportController::class, 'index'])->name('reportes.index');
    Route::get('reportes/ventas-ingresos',        [ReportController::class, 'ventasIngresos'])->name('reportes.ventas-ingresos');
    Route::get('reportes/ventas-marca',           [ReportController::class, 'ventasPorMarca'])->name('reportes.ventas-marca');
    Route::get('reportes/productos-mas-vendidos', [ReportController::class, 'productosMasVendidos'])->name('reportes.productos-mas-vendidos');
    Route::get('reportes/evolucion-inventario',   [ReportController::class, 'evolucionInventario'])->name('reportes.evolucion-inventario');


    // -------------------------------------------------------
    // MOVIMIENTOS (YA SIN RESOURCE)
    // -------------------------------------------------------
    Route::get('/movimientos',          [MovimientosController::class, 'index'])->name('movimientos.index');
    Route::get('/movimientos/entrada',  [MovimientosController::class, 'entrada'])->name('movimientos.entrada');
    Route::post('/movimientos/store',   [MovimientosController::class, 'store'])->name('movimientos.store');
    Route::get('/movimientos/salida',   [MovimientosController::class, 'salida'])->name('movimientos.salida');


    // -------------------------------------------------------
    // FILTROS
    // -------------------------------------------------------
    Route::get('/productos/stock-bajo', function () {
        return redirect()->route('inventario.index', ['filtro' => 'stock_bajo']);
    })->name('stock.bajo');

    Route::get('/ventas/hoy', function () {
        return redirect()->route('movimientos.index', ['fecha' => today()]);
    })->name('ventas.hoy');


    // -------------------------------------------------------
    // MARCAS AJAX
    // -------------------------------------------------------
    Route::post('/marcas/store-ajax', function (Request $request) {
        $marca = \App\Models\Marca::create([
            'nombre' => $request->nombre,
        ]);

        return response()->json($marca);
    });

});


// ---------------------------------------------------------------------
require __DIR__.'/auth.php';
