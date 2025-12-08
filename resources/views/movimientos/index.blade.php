@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">
    
    <main class="flex-1 p-8 md:p-10">

        {{-- TÍTULO --}}
        <h2 class="text-3xl font-bold text-gray-900">Movimientos de Inventario</h2>
        <p class="mb-10 text-gray-600">Historial de entradas y salidas de productos</p>

        {{-- ESTADÍSTICAS DE MOVIMIENTOS --}}
        <div class="grid grid-cols-1 gap-4 mb-10 md:grid-cols-3">

        {{-- Total de Entradas --}}
        <div class="flex items-center justify-between p-5 transition bg-green-100 border border-green-200 shadow-sm hover:bg-green-200 rounded-2xl">
            <div class="flex flex-col">
                <p class="text-sm font-medium text-green-800">Total de entradas</p>
                <p class="mt-1 text-3xl font-bold text-green-700">{{ $stats['entradas'] }}</p>
                <small class="text-green-700">Unidades en todo el historial</small>
            </div>
            <img src="{{ asset('images/analytics_statistics_arrow_arriba_chart_graph_stock_icon_267146.png') }}" alt="Entradas Icon" class="w-12 h-12" />
        </div>

        {{-- Total de Salidas --}}
        <div class="flex items-center justify-between p-5 transition bg-red-100 border border-red-200 shadow-sm hover:bg-red-200 rounded-2xl">
            <div class="flex flex-col">
                <p class="text-sm font-medium text-red-800">Total de salidas</p>
                <p class="mt-1 text-3xl font-bold text-red-700">{{ $stats['salidas'] }}</p>
                <small class="text-red-700">Unidades retiradas</small>
            </div>
            <img src="{{ asset('images/analytics_statistics_arrow_chart_graph_stock_icon_267146.png') }}" alt="Salidas Icon" class="w-12 h-12" />
        </div>

        {{-- Balance Neto --}}
        <div class="flex items-center justify-between p-5 transition border border-green-200 shadow-sm bg-green-50 hover:bg-green-100 rounded-2xl">
            <div class="flex flex-col">
                <p class="text-sm font-medium text-green-800">Balance neto</p>
                <p class="mt-1 text-3xl font-bold {{ $stats['balance'] >= 0 ? 'text-green-700' : 'text-red-700' }}">
                    {{ $stats['balance'] >= 0 ? '+' : '' }}{{ $stats['balance'] }}
                </p>
                <small class="text-green-700">Diferencia entre entradas y salidas</small>
            </div>
            <img src="{{ asset('images/wondicon-ui-free-parcel_111208.png') }}" alt="Balance Icon" class="w-12 h-12" />
        </div>

        </div>

        {{-- FILTROS Y BÚSQUEDA --}}
        <div class="p-4 mb-8 bg-white shadow rounded-2xl">
            <form method="GET" class="grid items-center w-full grid-cols-1 gap-4 md:grid-cols-3">

                {{-- Buscador --}}
                <div class="relative">
                    <svg class="absolute w-5 h-5 text-gray-400 left-3 top-2.5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m21 21-5.197-5.197A7.5 7.5 0 1 0 5.197 5.197 7.5 7.5 0 0 0 15.803 15.803Z" />
                    </svg>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Buscar por nombre o marca"
                        class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-400">
                </div>

                {{-- Filtro Marca --}}
                <select name="marca" class="py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-400">
                    <option value="">Todas las marcas</option>
                    @foreach($marcas as $marca)
                        <option value="{{ $marca->id }}" {{ request('marca') == $marca->id ? 'selected' : '' }}>
                            {{ $marca->nombre }}
                        </option>
                    @endforeach
                </select>

                {{-- Filtro Stock --}}
                <select name="tipo" class="py-2 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-400">
                    <option value="">Todo el stock</option>
                    <option value="entrada" {{ request('tipo') == 'entrada' ? 'selected' : '' }}>Solo Entradas</option>
                    <option value="salida" {{ request('tipo') == 'salida' ? 'selected' : '' }}>Solo Salidas</option>
                </select>

            </form>
        </div>


        {{-- BOTONES --}}
        <div class="flex justify-end gap-4 mb-6">
            <a href="{{ route('movimientos.entrada') }}" 
               class="flex items-center gap-2 px-4 py-2 font-semibold text-white bg-[#97BB5C] shadow-md rounded-xl hover:bg-[#749646]">
               
                Agregar Entrada
            </a>

            <a href="{{ route('movimientos.salida') }}" 
               class="flex items-center gap-2 px-4 py-2 font-semibold text-red-700 bg-red-100 border border-red-300 shadow-md rounded-xl hover:bg-red-200">

                Agregar Salida
            </a>
        </div>

        {{-- TABLA --}}
        <div class="p-6 bg-white border border-gray-200 shadow-lg rounded-xl">
            <h3 class="mb-6 text-2xl font-semibold text-gray-800">Historial de movimientos</h3>

            <div class="overflow-x-auto">
                <table class="w-full divide-y divide-gray-200">
                    <thead class="text-xs font-semibold tracking-wider text-left text-gray-600 uppercase bg-gray-50">
                        <tr>
                            <th class="px-6 py-3">Fecha</th>
                            <th class="px-6 py-3">Usuario</th>
                            <th class="px-6 py-3">Producto</th>
                            <th class="px-6 py-3">Tipo</th>
                            <th class="px-6 py-3 text-right">Cantidad</th>
                        </tr>
                    </thead>

                    <tbody class="bg-white divide-y divide-gray-200">

                        @forelse ($movimientos as $mov)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 text-sm text-gray-800">
                                {{ $mov->created_at->format('d/m/Y H:i') }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $mov->usuario->name ?? '---' }}
                            </td>

                            <td class="px-6 py-4 text-sm text-gray-700">
                                {{ $mov->producto->nombre }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-semibold rounded-full
                                {{ $mov->tipo == 'entrada' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}">
                                    {{ ucfirst($mov->tipo) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 text-right font-semibold
                            {{ $mov->tipo == 'entrada' ? 'text-green-600' : 'text-red-600' }}">
                                {{ $mov->tipo == 'entrada' ? '+' : '-' }}{{ $mov->cantidad }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-6 text-center text-gray-500">
                                No hay movimientos registrados.
                            </td>
                        </tr>
                        @endforelse

                    </tbody>
                </table>
            </div>
        </div>

    </main>

</div>
@endsection
