@extends('layouts.app')

@section('title', 'Registro de Producto')

@section('content')

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Gestión de Inventario</h1>
    <p class="text-gray-500">Administra todos los productos de calzado</p>
</div>

<h2 class="text-xl font-bold text-gray-700 mb-4">Registro de producto</h2>
<p class="text-gray-500 mb-6">Añade nuevos productos a tu inventario</p>

<div class="bg-white p-8 rounded-xl shadow-lg border border-green-200">
    <div class="flex items-center text-xl font-semibold text-gray-800 mb-8">
        <span class="text-green-500 mr-3">+</span> Agregar producto
    </div>

    <form action="{{ route('productos.store') }}" method="POST" class="space-y-6">
        @csrf
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del producto *</label>
                <input type="text" name="nombre" id="nombre" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-2.5">
            </div>

            <div>
                <label for="proveedor" class="block text-sm font-medium text-gray-700">Proveedor *</label>
                <input type="text" name="proveedor" id="proveedor" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-2.5">
            </div>

            <div>
                <label for="precio" class="block text-sm font-medium text-gray-700">Precio *</label>
                <input type="number" name="precio" id="precio" step="0.01" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-2.5">
            </div>

            <div>
                <label for="stock_inicial" class="block text-sm font-medium text-gray-700">Stock inicial *</label>
                <input type="number" name="stock_inicial" id="stock_inicial" required 
                       class="mt-1 block w-full border-gray-300 rounded-lg shadow-sm focus:border-green-500 focus:ring-green-500 p-2.5">
            </div>
        </div>

        <div class="flex justify-end pt-4 space-x-4 border-t border-gray-100 mt-8">
            <button type="button" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Limpiar
            </button>
            <a href="{{ route('productos.index') }}" class="px-4 py-2 text-gray-600 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                Cancelar
            </a>
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition">
                Guardar producto
            </button>
        </div>
    </form>
</div>

@endsection