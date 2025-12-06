@extends('layouts.app')

@section('content')
<div class="flex w-full min-h-screen bg-gray-50">

    {{-- SIDEBAR --}}
    <aside class="w-64 min-h-screen p-6 bg-white shadow-md">

        <div class="flex items-center gap-2 mb-10 text-xl font-semibold">
            <img 
                src="{{ asset('images/logo.png') }}" 
                alt="Logo de Stock Managger" 
                class="object-contain mt-10 w-28 h-28" 
            >
            STOCK MANAGER
        </div>

        <nav class="pt-10 space-y-4">
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-2 text-gray-700 transition duration-150 hover:text-green-600"> 
                <img src="{{ asset('images/dashboard_icon_221153.png') }}" class="w-6 h-6">
                Dashboard
            </a>

            <a href="#" 
               class="flex items-center gap-2 text-gray-700 transition duration-150 hover:text-green-600">
                <img src="{{ asset('images/wondicon-ui-free-parcel_111208.png') }}" class="w-6 h-6">
                Inventario
            </a>

            <a href="{{ route('movimientos.index') }}"
                class="flex items-center gap-2 px-3 py-2 font-semibold text-green-900 transition duration-150 bg-green-200 rounded-md">
                <img src="{{ asset('images/arrow_data_transfer_vertical_sync_icon_183025.png') }}"
                    class="w-4 h-4">
                Movimientos
            </a>

            <a href="#" class="flex items-center gap-2 text-gray-700 transition duration-150 hover:text-green-600">
                <img src="{{ asset('images/graphical-business-presentation-on-a-screen_icon-icons.com_73240.png') }}" class="w-4 h-4"> 
                Reportes
            </a>

            <a href="#" class="flex items-center gap-2 text-gray-700 transition duration-150 hover:text-green-600">
                <img src="{{ asset('images/4105943-accounts-group-people-user-user-group-users_113923.png') }}" class="w-4 h-4">
                Usuarios
            </a>

            <a href="#" class="flex items-center gap-2 text-gray-700 transition duration-150 hover:text-green-600">
                <img src="{{ asset('images/descargar (5).png') }}" class="w-4 h-4">
                Proveedores
            </a>
        </nav>
    </aside>

    {{-- CONTENIDO --}}
    <main class="flex-1 p-8 md:p-10">

        {{-- BUSCADOR Y USUARIO --}}
        <div class="flex items-center justify-between w-full pb-6">
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <svg class="absolute w-5 h-5 text-gray-400 left-3 top-2.5" fill="none" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="m21 21-5.197-5.197A7.5 7.5 0 1 0 5.197 5.197 7.5 7.5 0 0 0 15.803 15.803Z" />
                    </svg>
                    <input type="text"
                        placeholder="Buscar"
                        class="w-full py-2 pl-10 pr-4 transition duration-150 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-400">
                </div>
            </div>

            <div class="flex items-center gap-4 md:gap-6">
                <img src="{{ asset('images/notification_time_bell_alert_alarm_icon_220036.png') }}" class="w-6 h-6 cursor-pointer hover:opacity-75">
                <img src="{{ asset('images/user_man_accept_21961.png') }}" class="w-8 h-8 cursor-pointer hover:opacity-75">
            </div>
        </div>
        
        {{-- TITULO --}}
        <h2 class="mt-4 text-3xl font-bold text-gray-900">Movimientos de Inventario</h2>
        <p class="mb-8 text-gray-600">Historial de entradas y salidas de productos</p>

        {{-- BOTONES --}}
        <div class="flex justify-end gap-4 mb-6">
            <a href="{{ route('movimientos.entrada') }}" 
               class="flex items-center gap-2 px-4 py-2 font-semibold text-white bg-green-600 shadow-md rounded-xl hover:bg-green-700">
                <svg class="w-5 h-5" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Agregar Entrada
            </a>

            <a href="{{ route('movimientos.salida') }}" 
               class="flex items-center gap-2 px-4 py-2 font-semibold text-red-700 bg-red-100 border border-red-300 shadow-md rounded-xl hover:bg-red-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                Agregar Salida
            </a>
        </div>

        {{-- TABLA DE MOVIMIENTOS --}}
        <div class="p-6 bg-white border border-gray-200 shadow-lg rounded-xl">
            <h3 class="mb-6 text-2xl font-semibold text-gray-800">Historial de movimientos</h3>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-xs font-semibold tracking-wider text-left text-gray-500 uppercase bg-gray-50">
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

                                {{-- FECHA --}}
                                <td class="px-6 py-4">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ $mov->created_at->format('Y-m-d') }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        {{ $mov->created_at->format('H:i') }}
                                    </p>
                                </td>

                                {{-- USUARIO --}}
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 mr-3 text-sm font-semibold 
                                            {{ $mov->tipo == 'entrada' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} 
                                            rounded-full">
                                            {{ strtoupper(substr($mov->usuario->nombre, 0, 2)) }}
                                        </span>
                                        {{ $mov->usuario->nombre }}
                                    </div>
                                </td>

                                {{-- PRODUCTO --}}
                                <td class="px-6 py-4 text-sm text-gray-700">
                                    {{ $mov->producto->nombre }}
                                </td>

                                {{-- TIPO --}}
                                <td class="px-6 py-4">
                                    <span class="inline-flex px-3 py-1 text-xs font-semibold rounded-full
                                        {{ $mov->tipo == 'entrada' ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}">
                                        {{ ucfirst($mov->tipo) }}
                                    </span>
                                </td>

                                {{-- CANTIDAD --}}
                                <td class="px-6 py-4 font-semibold text-right
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
