<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Collection;



class ReportController extends Controller
{
    
    public function index()
    {
       try {
           
            $totalProductos = DB::table('products')->count(); 
            
           
         
            $totalVentas = 0;
            
            $productosBajoStock = collect(); 

            
           return view('reports.index', [ 
                'totalProductos' => $totalProductos,
                'totalVentas' => $totalVentas,
                'productosBajoStock' => $productosBajoStock,
            ]);

        } catch (\Exception $e) {
            
            
            dd("¡ERROR CRÍTICO! Tu ReportController no pudo ejecutarse.", "Causa:", $e->getMessage()); 
        }
    }
    
    
    
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
