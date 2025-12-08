@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-lg bg-white shadow-lg p-6 rounded">

    <h1 class="text-2xl font-bold mb-6">Editar Producto</h1>

    <form action="{{ route('inventario.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label class="block mb-2 font-semibold">Nombre:</label>
        <input type="text" name="nombre" 
               value="{{ $producto->nombre }}" 
               class="w-full border px-3 py-2 rounded mb-4" required>

        <label class="block mb-2 font-semibold">Marca:</label>
        <select name="marca_id" class="w-full border px-3 py-2 rounded mb-4" required>
            @foreach ($marcas as $m)
                <option value="{{ $m->id }}" 
                        {{ $producto->marca_id == $m->id ? 'selected' : '' }}>
                    {{ $m->nombre }}
                </option>
            @endforeach
        </select>

        <label class="block mb-2 font-semibold">Talla:</label>
        <input type="text" name="talla" value="{{ $producto->talla }}"
               class="w-full border px-3 py-2 rounded mb-4">

        <label class="block mb-2 font-semibold">Existencia:</label>
        <input type="number" name="existencia" value="{{ $producto->existencia }}"
               class="w-full border px-3 py-2 rounded mb-4" required>

        <label class="block mb-2 font-semibold">Precio:</label>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}"
               class="w-full border px-3 py-2 rounded mb-4" required>

        <div class="flex justify-between mt-4">
            <a href="{{ route('inventario.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">Cancelar</a>

            <button class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded">
                Actualizar
            </button>
        </div>

    </form>
</div>
@endsection
