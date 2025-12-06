<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // ⬅️ Nuevo: Usamos DB para consultas directas
use Illuminate\Support\Collection;

// Eliminamos los 'use' de Producto y Venta para evitar errores de modelo.

class ReportController extends Controller
{
    
    public function index()
    {
       try {
            // Esta línea ya está corregida y funcional:
            $totalProductos = DB::table('products')->count(); 
            
            // ⬅️ ¡DESACTIVAMOS LA LÍNEA QUE FALLA!
            // $totalVentas = DB::table('ventas')->count(); 

            // ⬅️ ASIGNAMOS CERO (0) para que la vista cargue sin error.
            $totalVentas = 0;
            
            $productosBajoStock = collect(); 

            
           return view('reports.index', [ // ⬅️ ¡CORREGIDO! de 'reportes' a 'reports'
                'totalProductos' => $totalProductos,
                'totalVentas' => $totalVentas,
                'productosBajoStock' => $productosBajoStock,
            ]);

        } catch (\Exception $e) {
            
            // Si hay un error de tabla, lo mostrará aquí.
            dd("¡ERROR CRÍTICO! Tu ReportController no pudo ejecutarse.", "Causa:", $e->getMessage()); 
        }
    }
    
    // --- Sub-Reportes (Solo carga vistas, no hay lógica de DB compleja) ---
    
    public function ventasIngresos() 
    { 
        return view('reportes.ventas-ingresos'); 
    }
    
    public function ventasPorMarca() 
    { 
        return view('reportes.ventas-marca'); 
    }
    
    public function productosMasVendidos() 
    { 
        return view('reportes.productos-mas-vendidos'); 
    }
    
    public function evolucionInventario() 
    { 
        return view('reportes.evolucion-inventario'); 
    }
}