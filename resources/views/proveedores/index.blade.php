@extends('layouts.app')

@section('title','Gestión de Proveedores')

@section('content')
<div class="p-10">

    {{-- ENCABEZADO --}}
    <h1 class="text-3xl font-bold">Gestión de Proveedores</h1>
    <p class="mb-8 text-gray-600">Administra los Proveedores del sistema</p>

    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 gap-6 mb-10 md:grid-cols-3">

        <div class="p-6 bg-white shadow rounded-2xl">
            <p class="text-sm text-gray-600">Total Proveedores</p>
            <h2 class="mt-2 text-3xl font-bold">{{ $stats['total'] }}</h2>
        </div>

        <div class="p-6 shadow bg-green-50 rounded-2xl">
            <p class="text-sm text-green-700">Activos</p>
            <h2 class="mt-2 text-3xl font-bold text-green-700">{{ $stats['activos'] }}</h2>
        </div>

        <div class="p-6 bg-green-100 shadow rounded-2xl">
            <p class="text-sm text-green-700">Compras Total</p>
            <h2 class="mt-2 text-3xl font-bold text-green-700">${{ number_format($stats['compras'],0) }}</h2>
        </div>

    </div>

    {{-- BUSCADOR + BOTON --}}
    <div class="flex items-center justify-between w-full pb-6">

        {{-- Buscador --}}
        <form action="{{ route('proveedores.index') }}" method="GET" class="w-full md:w-2/3">
            <div class="relative">
                <svg class="absolute w-5 h-5 text-gray-400 left-3 top-2.5"
                    xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.197 5.197a7.5 7.5 0 0 0 10.606 10.606Z" />
                </svg>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Buscar por nombre, empresa o email..."
                    class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-400">
            </div>
        </form>

        {{-- Botón agregar --}}
        <a href="{{ route('proveedores.create') }}"
           class="px-6 py-2 ml-6 text-white bg-[#97BB5C] rounded-full hover:bg-green-700">
            + Agregar Proveedor
        </a>
    </div>

    {{-- LISTADO --}}
<div class="grid grid-cols-1 gap-6">

    @foreach($proveedores as $proveedor)

        {{-- TARJETA DEL PROVEEDOR --}}
        <div class="w-full p-6 transition bg-white border border-gray-200 shadow-md rounded-2xl hover:shadow-lg">

            {{-- ENCABEZADO --}}
            <div class="flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-800">{{ $proveedor->nombre_contacto }}</h2>

            {{-- ESTADO --}}
            <div class="flex items-center gap-2 px-4 py-2 mt-1 font-semibold text-white bg-green-300 shadow-md rounded-xl">
                <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                <span class="text-sm font-semibold text-green-700">Activo</span>
            </div>

                {{-- Acciones --}}
                <div class="flex items-center gap-3">
                    <a href="{{ route('proveedores.show', $proveedor) }}">
                        <img src="{{ asset('images/eye_visible_hide_hidden_show_icon_145988.png') }}" class="w-5 opacity-70 hover:opacity-100">
                    </a>

                    <a href="{{ route('proveedores.edit', $proveedor) }}">
                        <img src="{{ asset('images/creative_design_draw_illustration_pen_pencil_write_icon_123895.png') }}" class="w-5 opacity-70 hover:opacity-100">
                    </a>

                    <form action="{{ route('proveedores.destroy', $proveedor) }}"
                          method="POST"
                          onsubmit="return confirm('¿Eliminar proveedor?');">
                        @csrf
                        @method('DELETE')
                        <button>
                            <img src="{{ asset('images/1485477104-basket_78591.png') }}" class="w-5 opacity-70 hover:opacity-100">
                        </button>
                    </form>
                </div>
            </div>

           
            {{-- INFORMACIÓN GENERAL --}}
            <p class="flex items-center gap-2 mt-2 font-medium text-gray-700">
                <img src="{{ asset('images/company_workplace_building_office_icon_262568.png') }}" class="w-4">
                {{ $proveedor->nombre_empresa }}
            </p>


            <div class="mt-2 space-y-1 text-sm text-gray-600">
                 @if($proveedor->descripcion)
                    <p class="flex items-center gap-2">
                        {{ $proveedor->descripcion }}
                    </p>
                @endif
                @if($proveedor->email)
                    <p class="flex items-center gap-2">
                        <img src="{{ asset('images/email-envelope-outline-shape-with-rounded-corners_icon-icons.com_56530.png') }}" class="w-4">
                        {{ $proveedor->email }}
                    </p>
                @endif

                @if($proveedor->telefono)
                    <p class="flex items-center gap-2">
                        <img src="{{ asset('images/phone-handset_icon-icons.com_48252.png') }}" class="w-4">
                        {{ $proveedor->telefono }}
                    </p>
                @endif

                @if($proveedor->direccion)
                    <p class="flex items-center gap-2">
                        <img src="{{ asset('images/1904662-location-map-map-location-map-point-pin-place-placeholder_122512.png') }}" class="w-4">
                        {{ $proveedor->direccion }}
                    </p>
                @endif
            </div>

            {{-- ESTADÍSTICAS EXTRA --}}
            <div class="flex justify-between mt-4 text-sm font-medium text-gray-700">
                <span>Productos: {{ $stats['total_productos'] }}</span>
                <span>Total Compras: ${{ number_format($stats['total_compras'], 0) }}</span>
            </div>

        </div>

    @endforeach

    <div class="mt-6">
        {{ $proveedores->links() }}
    </div>

</div>
@endsection
