@extends('layouts.app')

@section('title', 'Inventario')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Gestión de Inventario</h1>

    <a href="{{ route('inventario.create') }}"
       class="flex items-center gap-2 px-4 py-2 font-semibold text-white bg-[#97BB5C] shadow-md rounded-xl hover:bg-[#749646">
       + Agregar Producto
    </a>
</div>

<p class="mb-6 text-gray-500">Administra todos los productos de calzado</p>


<div class="p-5 mb-6 bg-white shadow-lg rounded-xl">

    <div class="flex items-center gap-3">
        
        <!-- busqueda -->
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

        <!-- select de marcas -->
        <select class="px-4 py-2 text-gray-700 border rounded-full shadow-sm focus:ring-green-400">
            <option>Todas las marcas</option>
        </select>

        <!-- select de stock -->
        <select class="px-4 py-2 text-gray-700 border rounded-full shadow-sm focus:ring-green-400">
            <option>Todo el stock</option>
        </select>

    </div>
</div>

<!-- tabla de productos -->
<div class="p-6 bg-white shadow-xl rounded-2xl">

    <h2 class="mb-6 text-2xl font-semibold">Productos ({{ count($productos) }})</h2>

    <table class="w-full table-auto">

        
        <thead>
            <tr class="text-gray-700 border-b">
                <th class="pb-3 text-left">Producto</th>
                <th class="pb-3 text-left">Marca</th>
                <th class="pb-3 text-left">Talla</th>
                <th class="pb-3 text-left">Stock</th>
                <th class="pb-3 text-left">Precio</th>
                <th class="pb-3 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($productos as $p)
                <tr class="transition border-b hover:bg-gray-100">
                    
                    <!-- producto -->
                    <td class="flex items-center gap-4 py-4">
                        <img src="{{ $p->imagen ? asset('storage/'.$p->imagen) : '/img/default.jpg' }}"
                            class="object-cover shadow-md w-14 h-14 rounded-xl">

                        <span class="text-lg font-semibold text-gray-800">
                            {{ $p->nombre }}
                        </span>
                    </td>

                    <!-- marca -->
                    <td>
                        <span class="px-4 py-1 text-sm font-medium bg-gray-200 rounded-full shadow-sm">
                            {{ $p->marca->nombre ?? 'Sin marca' }}
                        </span>
                    </td>

                    <!-- talla -->
                    <td class="font-medium text-gray-700">
                        {{ $p->talla }}
                    </td>

                    <!-- existencia -->
                    <td>
                        @if ($p->existencia >= 20)
                            <span class="px-4 py-1 text-sm text-green-900 bg-green-200 rounded-full shadow-sm">
                                Alto Stock
                            </span>
                        @elseif ($p->existencia >= 10)
                            <span class="px-4 py-1 text-sm text-yellow-900 bg-yellow-200 rounded-full shadow-sm">
                                Stock Medio
                            </span>
                        @else
                            <span class="px-4 py-1 text-sm text-red-900 bg-red-200 rounded-full shadow-sm">
                                Bajo Stock
                            </span>
                        @endif
                    </td>

                    <!-- precio -->
                    <td class="text-lg font-semibold text-gray-800">
                        ${{ number_format($p->precio, 2) }}
                    </td>

                    <!-- acciones -->
                    <td class="text-center">
                        <div class="flex items-center justify-center gap-4">

                            <!-- ver -->
                            <a href="{{ route('inventario.show', $p->id) }}"
                            title="Ver">
                                <img src="/images/eye_visible_hide_hidden_show_icon_145988.png" 
                                    class="transition-transform cursor-pointer w-7 h-7 hover:scale-110">
                            </a>

                            <!-- editar -->
                            <a href="{{ route('inventario.edit', $p->id) }}"
                            title="Editar">
                                <img src="/images/creative_design_draw_illustration_pen_pencil_write_icon_123895.png" 
                                    class="transition-transform cursor-pointer w-7 h-7 hover:scale-110">
                            </a>

                            <!-- eliminar -->
                            <form action="{{ route('inventario.destroy', $p->id) }}" 
                                method="POST"
                                onsubmit="return confirm('¿Eliminar producto?')">
                                @csrf
                                @method('DELETE')

                                <button type="submit" title="Eliminar">
                                    <img src="/images/1485477104-basket_78591.png" 
                                        class="transition-transform cursor-pointer w-7 h-7 hover:scale-110">
                                </button>
                            </form>

                        </div>
                    </td>


                    
                </tr>
            @endforeach
            </tbody>


    </table>
    
</div>


@endsection



