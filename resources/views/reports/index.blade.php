@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="mb-2 text-3xl font-bold">Reportes y Análisis</h1>
    <p class="mb-6 text-gray-600">Estadísticas y métricas del negocio</p>

    {{-- Tarjetas principales --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-4">

        {{-- Ventas Totales --}}
        <div class="p-6 bg-white border-l-4 border-green-500 shadow rounded-xl">
            <p class="font-semibold text-green-700">Ventas Totales</p>
            <h2 class="mt-2 text-3xl font-bold">${{ number_format($totalVentas, 2) }}</h2>
            <p class="text-sm text-gray-500">Ingresos brutos generados</p>
        </div>

        {{-- Productos en Stock --}}
        <div class="p-6 bg-white border-l-4 border-blue-500 shadow rounded-xl">
            <p class="font-semibold text-blue-700">Productos en Stock</p>
            <h2 class="mt-2 text-3xl font-bold">{{ number_format($totalProductos) }}</h2>
            <p class="text-sm text-gray-500">Total de artículos inventariados</p>
        </div>

        {{-- Ticket Promedio --}}
        <div class="p-6 bg-white border-l-4 shadow rounded-xl border-cyan-500">
            <p class="font-semibold text-cyan-700">Ticket Promedio</p>
            <h2 class="mt-2 text-3xl font-bold">$0.00</h2>
            <p class="text-sm text-gray-500">Requiere datos de ventas</p>
        </div>

        {{-- Rotación Stock --}}
        <div class="p-6 bg-white border-l-4 border-red-500 shadow rounded-xl">
            <p class="font-semibold text-red-700">Rotación de Stock</p>
            <h2 class="mt-2 text-3xl font-bold">0x</h2>
            <p class="text-sm text-gray-500">Basado en movimientos</p>
        </div>

    </div>

    {{-- Gráficos (cajas vacías por ahora) --}}
    <div class="grid grid-cols-1 gap-6 mb-8 md:grid-cols-2">

        <div class="p-6 bg-white shadow rounded-xl">
            <h3 class="mb-2 text-xl font-semibold">Tendencia de ventas</h3>
            <p class="mb-4 text-gray-500">Ventas mensuales</p>
            <div class="flex items-center justify-center h-64 bg-gray-100 border border-gray-300 rounded-xl">
                [Gráfico de barras aquí]
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-xl">
            <h3 class="mb-2 text-xl font-semibold">Ventas por marca</h3>
            <p class="mb-4 text-gray-500">Distribución del mercado</p>
            <div class="flex items-center justify-center h-64 bg-gray-100 border border-gray-300 rounded-xl">
                [Gráfico circular aquí]
            </div>
        </div>

        <div class="p-6 bg-white shadow rounded-xl">
            <h3 class="mb-2 text-xl font-semibold">Productos más vendidos</h3>
            <p class="mb-4 text-gray-500">Ranking por unidades</p>
            <ul class="space-y-2">
                <li class="flex justify-between p-3 rounded shadow bg-gray-50">
                    <span class="font-semibold">Producto A</span>
                    <span class="text-gray-600">100 unidades</span>
                </li>
                <li class="flex justify-between p-3 rounded shadow bg-gray-50">
                    <span class="font-semibold">Producto B</span>
                    <span class="text-gray-600">85 unidades</span>
                </li>
            </ul>
        </div>

        <div class="p-6 bg-white shadow rounded-xl">
            <h3 class="mb-2 text-xl font-semibold">Evolución del Inventario</h3>
            <p class="mb-4 text-gray-500">Cambios de stock en el tiempo</p>
            <div class="flex items-center justify-center h-64 bg-gray-100 border border-gray-300 rounded-xl">
                [Gráfico de línea aquí]
            </div>
        </div>
        
    </div>


</div>
@endsection
