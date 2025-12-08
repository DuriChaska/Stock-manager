@extends('layouts.app')

@section('content')
<div class="w-full">

    {{-- ENCABEZADO --}}
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Inventario</h1>
            <p class="text-gray-500">Administra todos los productos de calzado</p>
        </div>

        <a href="{{ route('inventario.create') }}"
            class="bg-olive-600 text-white px-4 py-2 rounded-lg shadow hover:bg-olive-700">
            + Agregar Producto
        </a>
    </div>

    {{-- FILTROS --}}
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <h2 class="font-semibold text-lg mb-3">Filtros y Búsqueda</h2>

        <div class="flex gap-4">
            {{-- Buscador --}}
            <div class="flex items-center border rounded-lg px-3 flex-1">
                <input type="text" class="w-full outline-none p-2"
                    placeholder="Buscar por nombre o marca">
                <i class="fas fa-search text-gray-500"></i>
            </div>

            {{-- Select marca --}}
            <select class="border rounded-lg p-2 text-gray-700">
                <option>Todas las marcas</option>
            </select>

            {{-- Select stock --}}
            <select class="border rounded-lg p-2 text-gray-700">
                <option>Todo el stock</option>
            </select>
        </div>
    </div>

    {{-- TABLA DE PRODUCTOS --}}
    <div class="bg-white rounded-lg shadow p-4">
        <h2 class="font-bold text-xl mb-4">Productos ({{ count($productos) }})</h2>

        <table class="w-full">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3">Producto</th>
                    <th class="p-3">Marca</th>
                    <th class="p-3">Talla</th>
                    <th class="p-3">Stock</th>
                    <th class="p-3">Precio</th>
                    <th class="p-3 text-center">Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($productos as $p)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3 flex items-center gap-2">
                        <img src="https://cdn-icons-png.flaticon.com/512/892/892458.png"
                            class="w-8 h-8 opacity-70">
                        <span class="font-semibold text-gray-700">{{ $p->nombre }}</span>
                    </td>

                    <td class="p-3">
                        <span class="bg-gray-200 text-gray-700 px-2 py-1 rounded text-sm">
                            {{ $p->marca->nombre ?? 'Sin marca' }}
                        </span>
                    </td>

                    <td class="p-3">{{ $p->talla ?? '-' }}</td>

                    {{-- TAG DE STOCK --}}
                    <td class="p-3">
                        @if($p->existencia >= 20)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-sm">Alto Stock</span>
                        @elseif($p->existencia <= 5)
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-sm">Bajo Stock</span>
                        @else
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-sm">Stock Medio</span>
                        @endif
                    </td>

                    <td class="p-3 font-semibold">${{ number_format($p->precio, 2) }}</td>

                    <td class="p-3 flex justify-center gap-3">

                        <a href="#" class="text-gray-600 hover:text-gray-900">
                            <i class="fas fa-eye text-xl"></i>
                        </a>

                        <a href="{{ route('inventario.edit', $p->id) }}" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-edit text-xl"></i>
                        </a>

                        <form action="{{ route('inventario.destroy', $p->id) }}" method="POST"
                              onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800">
                                <i class="fas fa-trash text-xl"></i>
                            </button>
                        </form>

                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>
@endsection



