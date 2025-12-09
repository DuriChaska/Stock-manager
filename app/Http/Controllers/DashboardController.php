<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\Marca;
use Illuminate\Http\Request;


class DashboardController extends Controller
{
    
    public function index()
    {
        // Tarjetas resumen
        $total_productos = Producto::sum('existencia'); // total stock sumado
        $existencia_baja_count = Producto::where('existencia', '<', 10)->count();

        // Movimientos del día
        $movimientos_hoy = Movimiento::where('tipo', 'salida')
            ->whereDate('fecha', today())
            ->get();

        $ventas_hoy = $movimientos_hoy->sum('cantidad');
        $ingresos_hoy = $movimientos_hoy->sum('costo');

        // Gráfica barras (ventas semanales)
        $dias = ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'];
        $weekly_sales_data = [];

        foreach (range(0, 6) as $i) {
            $weekly_sales_data[] = Movimiento::where('tipo', 'salida')
                ->whereDate('fecha', now()->startOfWeek()->addDays($i))
                ->sum('cantidad');
        }

        // Gráfica dona (existencia por marca)
        $brand_distribution = Marca::withSum('productos as total_stock', 'existencia')->get();
        $brand_distribution_labels = $brand_distribution->pluck('nombre')->toArray();
        $brand_distribution_data = $brand_distribution->pluck('total_stock')->toArray();

        // Top 5 productos más vendidos del mes
        $top_products = Producto::select('productos.*')
            ->join('movimientos', 'productos.id', '=', 'movimientos.producto_id')
            ->where('movimientos.tipo', 'salida')
            ->whereMonth('fecha', now()->month)
            ->groupBy('productos.id')
            ->selectRaw('SUM(movimientos.cantidad) as total_ventas')
            ->orderByDesc('total_ventas')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'total_productos',
            'existencia_baja_count',
            'ventas_hoy',
            'ingresos_hoy',
            'dias',
            'weekly_sales_data',
            'brand_distribution_labels',
            'brand_distribution_data',
            'top_products'
        ));
    }
}
