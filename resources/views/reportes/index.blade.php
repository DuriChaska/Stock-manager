@extends('layouts.app')

@section('title', 'Reportes')

@section('content')

<div class="px-8 py-4">


    <div class="mb-6">
        <h1 class="text-3xl font-extrabold tracking-tight">Reportes y Análisis</h1>
        <p class="text-gray-500">Estadísticas y métricas del negocio</p>
    </div>

    <!-- configuracion de reporte -->
    <div class="flex flex-col gap-4 p-5 mb-8 bg-white shadow-md rounded-3xl">
        <h2 class="text-lg font-semibold">Configuración de reporte</h2>

        <div class="flex flex-wrap gap-4">
            <!-- filtro de periodo -->
            <form method="GET" class="flex items-center gap-3 px-4 py-2 rounded-full shadow-inner bg-gray-50">
                <span class="text-gray-500">
                    <i class="fa-regular fa-calendar"></i>
                </span>
                <select name="period"
                        class="text-sm font-medium text-gray-700 bg-transparent border-none outline-none"
                        onchange="this.form.submit()">
                    <option value="last_month" {{ $period === 'last_month' ? 'selected' : '' }}>Último mes</option>
                    <option value="last_quarter" {{ $period === 'last_quarter' ? 'selected' : '' }}>Último trimestre</option>
                    <option value="year" {{ $period === 'year' ? 'selected' : '' }}>Año actual</option>
                </select>
            </form>

            <!-- tipo de reporte (solo visual por ahora) -->
            <div class="flex items-center gap-3 px-4 py-2 rounded-full shadow-inner bg-gray-50">
                <span class="text-gray-500">
                    <i class="fa-regular fa-file-lines"></i>
                </span>
                <select class="text-sm font-medium text-gray-700 bg-transparent border-none outline-none">
                    <option>Reporte de venta</option>
                    <option disabled>Inventario (próximamente)</option>
                </select>
            </div>
        </div>
    </div>

    @php
        function badgeColor($valor) {
            if (is_null($valor)) return 'text-gray-400';
            return $valor >= 0 ? 'text-green-600' : 'text-red-600';
        }

        function badgeText($valor) {
            if (is_null($valor)) return 'Sin datos previos';
            $sign = $valor >= 0 ? '+' : '';
            return $sign . number_format($valor, 1) . '% vs periodo anterior';
        }
    @endphp

    <!-- tarjetas de metricas -->
    <div class="grid grid-cols-1 gap-5 mb-10 md:grid-cols-4">

        <!-- ventas totales (unidades) -->
        <div class="rounded-3xl p-5 bg-gradient-to-br from-[#e9f4df] to-white shadow-md flex flex-col justify-between">
            <div class="flex items-start justify-between mb-6">
                <h3 class="font-semibold text-gray-800">Ventas totales</h3>
                <i class="text-green-500 fa-solid fa-arrow-trend-up"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-gray-900">{{ number_format($ventasTotales) }}</p>
                <p class="text-xs mt-1 {{ badgeColor($ventasCambio) }}">
                    {{ badgeText($ventasCambio) }}
                </p>
            </div>
        </div>

        <!-- ingresos -->
        <div class="rounded-3xl p-5 bg-gradient-to-br from-[#dff4ec] to-white shadow-md flex flex-col justify-between">
            <div class="flex items-start justify-between mb-6">
                <h3 class="font-semibold text-gray-800">Ingresos</h3>
                <i class="fa-solid fa-arrow-down-short-wide text-emerald-500"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-gray-900">${{ number_format($ingresosTotales, 2) }}</p>
                <p class="text-xs mt-1 {{ badgeColor($ingresosCambio) }}">
                    {{ badgeText($ingresosCambio) }}
                </p>
            </div>
        </div>

        <!-- ticket promedio -->
        <div class="rounded-3xl p-5 bg-gradient-to-br from-[#e0f3f0] to-white shadow-md flex flex-col justify-between">
            <div class="flex items-start justify-between mb-6">
                <h3 class="font-semibold text-gray-800">Ticket Promedio</h3>
                <i class="text-teal-500 fa-regular fa-clipboard"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-gray-900">${{ number_format($ticketPromedio, 2) }}</p>
                <p class="text-xs mt-1 {{ badgeColor($ticketCambio) }}">
                    {{ badgeText($ticketCambio) }}
                </p>
            </div>
        </div>

        <!-- rotación de stock -->
        <div class="rounded-3xl p-5 bg-gradient-to-br from-[#ecf4df] to-white shadow-md flex flex-col justify-between">
            <div class="flex items-start justify-between mb-6">
                <h3 class="font-semibold text-gray-800">Rotación Stock</h3>
                <i class="fa-solid fa-chart-simple text-lime-600"></i>
            </div>
            <div>
                <p class="text-3xl font-extrabold text-gray-900">{{ number_format($rotacionStock, 1) }}x</p>
                <p class="text-xs mt-1 {{ badgeColor($rotacionCambio) }}">
                    {{ badgeText($rotacionCambio) }}
                </p>
            </div>
        </div>

    </div>


    <!-- gráficos principales -->
    <div class="grid grid-cols-1 gap-6 mb-10 lg:grid-cols-2">

        <!-- tendencia -->
        <div class="p-6 bg-white shadow-md rounded-3xl">
            <h3 class="mb-1 text-lg font-semibold">Tendencia de Ventas e Ingresos</h3>
            <p class="mb-4 text-gray-500">{{ $periodLabel }}</p>
            <canvas id="ventasChart" height="160"></canvas>
        </div>

        <!-- dona marcas -->
        <div class="p-6 bg-white shadow-md rounded-3xl">
            <h3 class="mb-1 text-lg font-semibold">Distribución de Ventas por Marca</h3>
            <p class="mb-4 text-gray-500">{{ $periodLabel }}</p>
            <canvas id="marcasChart" height="160"></canvas>
        </div>

    </div>


    <!-- top productos -->
    <div class="p-6 mb-10 bg-white shadow-md rounded-3xl">
        <h3 class="mb-4 text-lg font-semibold">Productos más vendidos</h3>

        @if($topProductos->count() === 0)
            <p class="text-sm text-gray-400">Aún no hay ventas registradas en este periodo.</p>
        @else
            <div class="space-y-3">
                @foreach ($topProductos as $index => $p)
                    <div class="flex items-center justify-between p-4 transition border border-gray-100 rounded-2xl hover:bg-gray-50">
                        <div class="flex items-center gap-4">
                            <div class="w-9 h-9 flex items-center justify-center rounded-full bg-[#e3f0cb] text-[#769746] text-sm font-bold">
                                #{{ $index + 1 }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $p->nombre }}</p>
                                <p class="text-xs text-gray-500">
                                    {{ (int) $p->total_ventas }} unidades vendidas · ${{ number_format(($p->total_ventas ?? 0) * $p->precio, 2) }} aprox.
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

</div>



<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    // === tendencia ventas + ingresos ===
    const ventasLabels   = @json($ventasLineaLabels);
    const ventasCant     = @json($ventasLineaCantidades);
    const ventasIngresos = @json($ventasLineaIngresos);

    const ctxVentas = document.getElementById('ventasChart').getContext('2d');

    new Chart(ctxVentas, {
        type: 'bar',
        data: {
            labels: ventasLabels,
            datasets: [
                {
                    label: 'Unidades vendidas',
                    data: ventasCant,
                    backgroundColor: '#97BB5C',
                    borderRadius: 8
                },
                {
                    label: 'Ingresos',
                    data: ventasIngresos,
                    type: 'line',
                    yAxisID: 'y1',
                    borderColor: '#4b7f3b',
                    backgroundColor: 'rgba(75, 127, 59, 0.15)',
                    tension: 0.3,
                    pointRadius: 3
                }
            ]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: { stepSize: 1 }
                },
                y1: {
                    position: 'right',
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });

    // === dona ventas marca ===
    const marcasLabels = @json($ventasPorMarcaLabels);
    const marcasData   = @json($ventasPorMarcaData);

    const ctxMarcas = document.getElementById('marcasChart').getContext('2d');

    new Chart(ctxMarcas, {
        type: 'doughnut',
        data: {
            labels: marcasLabels,
            datasets: [{
                data: marcasData,
                backgroundColor: ['#97BB5C', '#749646', '#B4D791', '#DAEFCB', '#e0e0e0'],
                borderWidth: 1
            }]
        },
        options: {
            cutout: '60%',
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>

@endsection
