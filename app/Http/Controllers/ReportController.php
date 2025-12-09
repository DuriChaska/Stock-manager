<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Marca;
use Carbon\Carbon;

class ReportController extends Controller
{
    
    public function index()
    {
       //periodo de reporte
        $period = request('period', 'last_month'); // ultimo mes | ultimo trimestre | año
        $today  = Carbon::today();

        switch ($period) {
            case 'last_quarter':
                // ultimo trimestre 
                $currentStart  = $today->copy()->startOfQuarter()->subQuarter();
                $currentEnd    = $today->copy()->startOfQuarter()->subDay();
                $previousStart = $currentStart->copy()->subQuarter();
                $previousEnd   = $currentEnd->copy()->subQuarter();
                $periodLabel   = 'Último trimestre';
                break;

            case 'year':
                // año actual
                $currentStart  = $today->copy()->startOfYear();
                $currentEnd    = $today;
                $previousStart = $currentStart->copy()->subYear();
                $previousEnd   = $currentEnd->copy()->subYear();
                $periodLabel   = 'Año actual';
                break;

            case 'last_month':
            default:
                // ultimo mes
                $lastMonth     = $today->copy()->subMonth();
                $currentStart  = $lastMonth->copy()->startOfMonth();
                $currentEnd    = $lastMonth->copy()->endOfMonth();
                $previousStart = $currentStart->copy()->subMonth();
                $previousEnd   = $currentEnd->copy()->subMonth();
                $periodLabel   = 'Último mes';
                break;
        }

        //aplicar rango de fechas a movimientos de salida
        $baseMovimientos = Movimiento::where('tipo', 'salida');

        //metricas principales
        // ventas totales
        $ventasTotales = (clone $baseMovimientos)
            ->whereBetween('fecha', [$currentStart, $currentEnd])
            ->sum('cantidad');

        $ventasPrevias = (clone $baseMovimientos)
            ->whereBetween('fecha', [$previousStart, $previousEnd])
            ->sum('cantidad');

        // ingresos = SUM(cantidad * precio_producto)
        $ingresosTotales = (clone $baseMovimientos)
            ->whereBetween('fecha', [$currentStart, $currentEnd])
            ->join('productos', 'movimientos.producto_id', '=', 'productos.id')
            ->selectRaw('SUM(movimientos.cantidad * productos.precio) as total')
            ->value('total') ?? 0;

        $ingresosPrevios = (clone $baseMovimientos)
            ->whereBetween('fecha', [$previousStart, $previousEnd])
            ->join('productos', 'movimientos.producto_id', '=', 'productos.id')
            ->selectRaw('SUM(movimientos.cantidad * productos.precio) as total')
            ->value('total') ?? 0;

        // ticket promedio = ingresos / cantidad vendida 
        $ticketPromedio = $ventasTotales > 0 ? $ingresosTotales / $ventasTotales : 0;
        $ticketPrevio   = $ventasPrevias > 0 ? $ingresosPrevios / $ventasPrevias : 0;

        // Stock total
        $stockTotal = Producto::sum('existencia');

        // rotacion de stock = ventas del periodo / stock promedio
        $stockPromedio = Producto::avg('existencia') ?: 1;
        $rotacionStock = $ventasTotales / $stockPromedio;
        $rotacionPrev  = $ventasPrevias / $stockPromedio;

        //cambios con respecto al periodo previo
        $calcCambio = function ($actual, $previo) {
            if ($previo == 0) {
                return null; 
            }
            return (($actual - $previo) / $previo) * 100;
        };

        $ventasCambio   = $calcCambio($ventasTotales,   $ventasPrevias);
        $ingresosCambio = $calcCambio($ingresosTotales, $ingresosPrevios);
        $ticketCambio   = $calcCambio($ticketPromedio,  $ticketPrevio);
        $rotacionCambio = $calcCambio($rotacionStock,   $rotacionPrev);

        //grafica tendencias
        $ventasDiarias = (clone $baseMovimientos)
            ->whereBetween('fecha', [$currentStart, $currentEnd])
            ->join('productos', 'movimientos.producto_id', '=', 'productos.id')
            ->selectRaw('DATE(movimientos.fecha) as dia,
                         SUM(movimientos.cantidad) as total_cantidad,
                         SUM(movimientos.cantidad * productos.precio) as total_ingresos')
            ->groupBy('dia')
            ->orderBy('dia')
            ->get();

        $ventasLineaLabels     = $ventasDiarias->pluck('dia')->map(fn($d) => Carbon::parse($d)->format('d M'));
        $ventasLineaCantidades = $ventasDiarias->pluck('total_cantidad');
        $ventasLineaIngresos   = $ventasDiarias->pluck('total_ingresos');

        // Grafico ventas marcas
        $ventasMarca = Marca::with(['productos.movimientos' => function ($q) use ($currentStart, $currentEnd) {
                $q->where('tipo', 'salida')
                  ->whereBetween('fecha', [$currentStart, $currentEnd]);
            }])
            ->get();

        $ventasPorMarcaLabels = $ventasMarca->pluck('nombre');
        $ventasPorMarcaData   = $ventasMarca->map(function ($marca) {
            return $marca->productos->sum(fn($p) => $p->movimientos->sum('cantidad'));
        });

        // productos mas vendidos
        $topProductos = Producto::withSum(['movimientos as total_ventas' => function ($q) use ($currentStart, $currentEnd) {
                $q->where('tipo', 'salida')
                  ->whereBetween('fecha', [$currentStart, $currentEnd]);
            }], 'cantidad')
            ->orderByDesc('total_ventas')
            ->take(5)
            ->get();

        return view('reportes.index', compact(
            'period',
            'periodLabel',
            'ventasTotales',
            'ingresosTotales',
            'ticketPromedio',
            'rotacionStock',
            'stockTotal',
            'ventasCambio',
            'ingresosCambio',
            'ticketCambio',
            'rotacionCambio',
            'ventasLineaLabels',
            'ventasLineaCantidades',
            'ventasLineaIngresos',
            'ventasPorMarcaLabels',
            'ventasPorMarcaData',
            'topProductos'
        ));
    }
}
