@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    {{-- 🔍 BUSCADOR GLOBAL --}}
    <div class="relative flex items-center w-full px-4 py-2 bg-gray-100 rounded-lg">
        <input id="searchInput" type="text" placeholder="Buscar productos..." 
               class="flex-1 text-sm bg-transparent rounded-lg outline-none">

        <img src="{{ asset('images/3844432-magnifier-search-zoom_110300.png') }}" alt="Buscar" class="w-5 h-5 ml-2 cursor-pointer" />

        {{-- Resultados --}}
        <div id="resultBox"
             class="absolute left-0 z-50 hidden w-full mt-1 overflow-hidden transition-all duration-200 bg-white rounded shadow-lg top-full">
        </div>
    </div>

    {{-- Título --}}
    <div>
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-gray-600">Resumen general del inventario y ventas</p>
    </div>

    {{-- TARJETAS --}}
    <div class="grid grid-cols-4 gap-4">
        
        {{-- Total Productos --}}
        <a href="{{ route('productos.index') }}"class="flex items-center justify-between p-4 transition shadow bg-lime-200 hover:bg-lime-300 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Total Productos </span>
            <span class="text-3xl font-bold text-gray-800">{{ $total_productos }}</span>
        </div>
        <img src="{{ asset('images/wondicon-ui-free-parcel_111208.png') }}" alt="Icono de Productos" class="w-12 h-12" />
        </a>

        {{-- Stock Bajo --}}
        <a href="{{ route('stock.bajo') }}"class="flex items-center justify-between p-4 transition bg-red-200 shadow hover:bg-red-300 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Stock bajo</span>
            <span class="text-3xl font-bold text-red-700">{{ $existencia_baja_count }}</span>
        <small class="text-red-700">Productos con menos de 10 unidades</small>
        </div>
        <img src="{{ asset('images/analytics_statistics_arrow_chart_graph_stock_icon_267146.png') }}" alt="Icono de Advertencia" class="w-12 h-12" />
        </a>

       {{-- Ventas Hoy --}}
        <a href="{{ route('ventas.hoy') }}"class="flex items-center justify-between p-4 transition shadow bg-lime-100 hover:bg-lime-200 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Ventas hoy</span>
            <span class="text-3xl font-bold">{{ $ventas_hoy }}</span>
        </div>
        <img src="{{ asset('images/4105931-add-to-cart-buy-cart-sell-shop-shopping-cart_113919.png') }}" alt="Icono de Ventas" class="w-12 h-12" />
        </a>

        {{-- Ingresos Hoy --}}
        <a href="{{ route('ventas.hoy') }}"class="flex items-center justify-between p-4 transition bg-green-100 shadow hover:bg-green-200 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Ingresos hoy</span>
            <span class="text-3xl font-bold">${{ number_format($ingresos_hoy, 2) }}</span>
        </div>
        <img src="{{ asset('images/dollar_sign_icon_128878.png') }}" alt="Icono de Ingresos" class="w-12 h-12" />
        </a>
    </div>

    {{-- GRÁFICAS --}}
    <div class="grid grid-cols-2 gap-6">
        {{-- BARRAS --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl">
            <h3 class="mb-4 text-lg font-bold">Ventas de la semana</h3>
            <canvas id="weeklyChart"></canvas>
        </div>

        {{-- DONA --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl">
            <h3 class="mb-4 text-lg font-bold">Distribución de marcas</h3>
            <canvas id="brandChart"></canvas>
        </div>
    </div>

    {{-- TOP PRODUCTOS --}}
    <div class="p-6 bg-white shadow-lg rounded-2xl">
        <h3 class="mb-4 text-lg font-bold">Productos más vendidos este mes</h3>
        
        <div class="space-y-3">
        @foreach ($top_products as $i => $producto)
            <div class="flex items-center justify-between p-3 bg-gray-100 rounded-xl">
                <div>
                    <span class="font-bold">#{{ $i + 1 }}</span>
                    <span class="ml-2 font-semibold">{{ $producto->nombre }}</span>
                    <p class="text-sm text-gray-500">{{ $producto->total_ventas }} ventas</p>
                </div>

                <span class="px-3 py-1 rounded-full text-white {{ $producto->existencia < 10 ? 'bg-red-500' : 'bg-lime-600' }}">
                    Stock: {{ $producto->existencia }}
                </span>
            </div>
        @endforeach
        </div>
    </div>

</div>

{{-- SCRIPTS CHART.JS v4 --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // === GRÁFICA BARRAS ===
    new Chart(document.getElementById('weeklyChart'), {
        type: 'bar',
        data: {
            labels: @json($dias),
            datasets: [{
                label: 'Ventas',
                data: @json($weekly_sales_data),
                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 2,
                hoverBorderWidth: 3
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { display: false } }
        }
    });

    // === GRÁFICA DONA ===
    new Chart(document.getElementById('brandChart'), {
        type: 'doughnut',
        data: {
            labels: @json($brand_distribution_labels),
            datasets: [{
                data: @json($brand_distribution_data),
                backgroundColor: [
                    '#4ADE80', '#60A5FA', '#F87171',
                    '#FACC15', '#C084FC', '#FCA5A5'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: { legend: { position: 'bottom' } }
        }
    });


    // === BUSCADOR LIVE ===
    const searchInput = document.querySelector('#searchInput');
    const resultBox = document.querySelector('#resultBox');

    function buscar() {
        const q = searchInput.value;

        if (q.length < 2) {
            resultBox.classList.add('hidden');
            return;
        }

        fetch(`/buscar-productos?q=${q}`)
            .then(res => res.json())
            .then(data => {
                resultBox.innerHTML = data.length === 0
                    ? `<p class='px-3 py-2 text-sm text-gray-500'>No se encontraron productos</p>`
                    : data.map(p =>
                        `<a href="/productos/${p.id}" 
                          class="block px-3 py-2 text-sm transition hover:bg-gray-100">
                            ${p.nombre}
                        </a>`
                    ).join('');
                resultBox.classList.remove('hidden');
            });
    }

    searchInput.addEventListener('input', buscar);

});
</script>

@endsection
