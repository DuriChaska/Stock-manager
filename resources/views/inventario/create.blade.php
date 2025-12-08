@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')

<h1 class="mb-4 text-3xl font-bold">Gestión de Inventario</h1>
<p class="mb-8 text-gray-500">Añade nuevos productos a tu inventario</p>

<div class="p-8 bg-white shadow-xl rounded-xl">

    <h2 class="flex items-center gap-2 mb-6 text-2xl font-semibold">
        <i class="text-green-600 fa-solid fa-plus"></i>
        Agregar producto
    </h2>

    <form action="{{ route('inventario.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-2 gap-6">

            <!-- Nombre -->
            <div>
                <label class="font-medium">Nombre del producto *</label>
                <input type="text" name="nombre"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400 focus:border-green-500"
                       required>
            </div>

            <!-- Proveedor -->
            <div>
                <label class="font-medium">Proveedor *</label>
                <select name="marca"
                        class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400 focus:border-green-500"
                        required>
                    <option value="">Seleccione marca</option>
                    @foreach ($proveedores as $prov)
                        <option value="{{ $prov->nombre }}">{{ $prov->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Precio -->
            <div>
                <label class="font-medium">Precio *</label>
                <input type="number" step="0.01" name="precio"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400 focus:border-green-500"
                       required>
            </div>

            <!-- Stock -->
            <div>
                <label class="font-medium">Stock inicial *</label>
                <input type="number" name="stock"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400 focus:border-green-500"
                       required>
            </div>

            <!-- Imagen -->
            <div class="col-span-2">
                <label class="font-medium">Imagen del producto</label>
                <input type="file" name="imagen"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400 focus:border-green-500">
            </div>

        </div>

        <!-- Botones -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="{{ route('inventario.index') }}"
               class="px-5 py-2 transition bg-gray-200 rounded-full hover:bg-gray-300">
               Cancelar
            </a>

            <button type="submit"
                    class="px-6 py-2 text-white transition bg-green-600 rounded-full shadow-md hover:bg-green-700">
                <i class="mr-1 fa-solid fa-save"></i> Guardar producto
            </button>
        </div>

    </form>

</div>

@endsection




