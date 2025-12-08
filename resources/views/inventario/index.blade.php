@extends('layouts.app')

@section('title', 'Inventario')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Gestión de Inventario</h1>

    <a href="{{ route('inventario.create') }}"
       class="px-5 py-2 text-white transition bg-green-600 rounded-full shadow-md hover:bg-green-700">
       + Agregar Producto
    </a>
</div>

<p class="mb-6 text-gray-500">Administra todos los productos de calzado</p>

<!-- Filtros -->
<div class="p-5 mb-6 bg-white shadow-lg rounded-xl">

    <div class="flex items-center gap-3">
        
        <!-- Búsqueda -->
        <div class="relative flex-1">
            <span class="absolute text-gray-400 left-3 top-3">
                <i class="fa-solid fa-magnifying-glass"></i>
            </span>
            <input 
                type="text" 
                placeholder="Buscar por nombre o marca"
                class="w-full py-2 pl-10 border border-gray-300 rounded-full shadow-sm focus:border-green-500 focus:ring-green-400"
            >
        </div>

        <!-- Select de marcas -->
        <select class="px-4 py-2 text-gray-700 border rounded-full shadow-sm focus:ring-green-400">
            <option>Todas las marcas</option>
        </select>

        <!-- Select de stock -->
        <select class="px-4 py-2 text-gray-700 border rounded-full shadow-sm focus:ring-green-400">
            <option>Todo el stock</option>
        </select>

    </div>
</div>

<!-- Tabla de productos -->
<div class="p-6 bg-white shadow-xl rounded-xl">

    <h2 class="mb-5 text-xl font-semibold">
        Productos ({{ count($productos) }})
    </h2>

    <table class="w-full text-left">
        <thead>
            <tr class="text-gray-700 border-b">
                <th class="py-3">Producto</th>
                <th>Marca</th>
                <th>Talla</th>
                <th>Stock</th>
                <th>Precio</th>
                <th class="text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($productos as $p)
            <tr class="transition border-b hover:bg-gray-100">

                <td class="flex items-center gap-3 py-4">
                    <img 
                        src="{{ $p->imagen ?? 'https://via.placeholder.com/50' }}" 
                        class="object-cover w-12 h-12 rounded-md shadow-sm"
                    >
                    <span class="font-medium">{{ $p->nombre }}</span>
                </td>

                <td>
                    <span class="px-3 py-1 text-sm bg-gray-200 rounded-full">
                        {{ $p->marca }}
                    </span>
                </td>

                <td>{{ $p->talla }}</td>

                <td>
                    @if ($p->stock >= 20)
                        <span class="px-3 py-1 text-sm text-green-800 bg-green-200 rounded-full">
                            Alto Stock
                        </span>
                    @elseif ($p->stock >= 10)
                        <span class="px-3 py-1 text-sm text-yellow-800 bg-yellow-200 rounded-full">
                            Stock Medio
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm text-red-800 bg-red-200 rounded-full">
                            Bajo Stock
                        </span>
                    @endif
                </td>

                <td class="font-medium">${{ number_format($p->precio, 2) }}</td>

                <td>
                    <div class="flex justify-center gap-4 text-xl">

                        <a href="{{ route('inventario.show', $p->id) }}" 
                           class="text-gray-600 hover:text-black"
                           title="Ver">
                            <i class="fa-regular fa-eye"></i>
                        </a>

                        <a href="{{ route('inventario.edit', $p->id) }}" 
                           class="text-green-600 hover:text-green-800"
                           title="Editar">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </a>

                        <form action="{{ route('inventario.destroy', $p->id) }}" 
                              method="POST"
                              onsubmit="return confirm('¿Eliminar producto?')">
                            @csrf
                            @method('DELETE')
                            <button class="text-red-600 hover:text-red-800" title="Eliminar">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>

                    </div>
                </td>

            </tr>

            @empty
            <tr>
                <td colspan="6" class="py-4 text-center text-gray-500">
                    No hay productos registrados.
                </td>
            </tr>
            @endforelse
        </tbody>

    </table>

</div>

@endsection



