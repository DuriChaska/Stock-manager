<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    
    public function index()
    {
        try {

            // Usa la tabla correcta
            $totalProductos = DB::table('productos')->count();

            // Valores por ahora en 0
            $totalVentas = 0;
            $productosBajoStock = collect();

            return view('reports.index', [
                'totalProductos' => $totalProductos,
                'totalVentas' => $totalVentas,
                'productosBajoStock' => $productosBajoStock,
            ]);

        } catch (\Exception $e) {

            // Muestra el error real
            return dd("Error en ReportController@index:", $e->getMessage());
        }
    }

    public function ventasIngresos()
    {
        return view('reports.ventas_ingresos');
    }

    public function ventasPorMarca()
    {
        return view('reports.ventas_por_marca');
    }

    public function productosMasVendidos()
    {
        return view('reports.productos_mas_vendidos');
    }

    public function evolucionInventario()
    {
        return view('reports.evolucion_inventario');
    }
}
