@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    

    <div>
        <h1 class="text-3xl font-bold">Dashboard</h1>
        <p class="text-gray-600">Resumen general del inventario y ventas</p>
    </div>

    {{-- targetas--}}
    <div class="grid grid-cols-4 gap-4">
        
        {{-- productos --}}
        <a href="{{ route('productos.index') }}"class="flex items-center justify-between p-4 transition shadow bg-lime-200 hover:bg-lime-300 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Total Productos </span>
            <span class="text-3xl font-bold text-gray-800">{{ $total_productos }}</span>
        </div>
        <img src="{{ asset('images/wondicon-ui-free-parcel_111208.png') }}" alt="Icono de Productos" class="w-12 h-12" />
        </a>

        {{-- stock bajo --}}
        <a href="{{ route('stock.bajo') }}"class="flex items-center justify-between p-4 transition bg-red-200 shadow hover:bg-red-300 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Stock bajo</span>
            <span class="text-3xl font-bold text-red-700">{{ $existencia_baja_count }}</span>
        <small class="text-red-700">Productos con menos de 10 unidades</small>
        </div>
        <img src="{{ asset('images/analytics_statistics_arrow_chart_graph_stock_icon_267146.png') }}" alt="Icono de Advertencia" class="w-12 h-12" />
        </a>

       {{-- ventas --}}
        <a href="{{ route('ventas.hoy') }}"class="flex items-center justify-between p-4 transition shadow bg-lime-100 hover:bg-lime-200 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Ventas hoy</span>
            <span class="text-3xl font-bold">{{ $ventas_hoy }}</span>
        </div>
        <img src="{{ asset('images/4105931-add-to-cart-buy-cart-sell-shop-shopping-cart_113919.png') }}" alt="Icono de Ventas" class="w-12 h-12" />
        </a>

        {{-- ingresos --}}
        <a href="{{ route('ventas.hoy') }}"class="flex items-center justify-between p-4 transition bg-green-100 shadow hover:bg-green-200 rounded-xl">
        <div class="flex flex-col">
            <span class="text-lg font-semibold">Ingresos hoy</span>
            <span class="text-3xl font-bold">${{ number_format($ingresos_hoy, 2) }}</span>
        </div>
        <img src="{{ asset('images/dollar_sign_icon_128878.png') }}" alt="Icono de Ingresos" class="w-12 h-12" />
        </a>
    </div>

    {{-- graficas --}}
    <div class="grid grid-cols-2 gap-6">
        {{-- barras --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl">
            <h3 class="mb-4 text-lg font-bold">Ventas de la semana</h3>
            <canvas id="weeklyChart"></canvas>
        </div>

        {{-- dona --}}
        <div class="p-6 bg-white shadow-lg rounded-2xl">
            <h3 class="mb-4 text-lg font-bold">Distribución de marcas</h3>
            <canvas id="brandChart"></canvas>
        </div>
    </div>

    {{-- top --}}
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


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    //grafica barras
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

    //dona
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


    

});
</script>

@endsection
