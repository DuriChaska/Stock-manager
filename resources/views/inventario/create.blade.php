@extends('layouts.app')

@section('content')

<div class="w-full">

    {{-- TITULO --}}
    <h1 class="text-3xl font-bold text-gray-800 mb-1">Gestión de Inventario</h1>
    <p class="text-gray-500 mb-6">Administra todos los productos de calzado</p>

    {{-- TARJETA DEL FORMULARIO --}}
    <div class="bg-white w-full rounded-lg shadow p-6">

        <h2 class="text-2xl font-bold mb-1">Registro de producto</h2>
        <p class="text-gray-500 mb-6">Añade nuevos productos a tu inventario</p>

        <form action="{{ route('inventario.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-2 gap-6">

                {{-- NOMBRE --}}
                <div>
                    <label class="font-semibold">Nombre del producto *</label>
                    <input name="nombre" type="text"
                        class="w-full border p-2 rounded mt-1 focus:border-olive-600"
                        required>
                </div>

                {{-- MARCA --}}
                <div>
                    <label class="font-semibold">Proveedor *</label>
                    <select name="marca_id"
                        class="w-full border p-2 rounded mt-1 focus:border-olive-600"
                        required>
                        <option value="">Seleccione marca</option>
                        @foreach ($marcas as $m)
                            <option value="{{ $m->id }}">{{ $m->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- PRECIO --}}
                <div>
                    <label class="font-semibold">Precio *</label>
                    <input name="precio" type="number" step="0.01"
                        class="w-full border p-2 rounded mt-1"
                        required>
                </div>

                {{-- STOCK --}}
                <div>
                    <label class="font-semibold">Stock inicial *</label>
                    <input name="existencia" type="number"
                        class="w-full border p-2 rounded mt-1"
                        required>
                </div>

            </div>

            {{-- BOTONES --}}
            <div class="flex justify-end mt-6 gap-3">

                <button type="reset"
                    class="px-4 py-2 bg-white text-gray-700 border rounded">
                    Limpiar
                </button>

                <a href="{{ route('inventario.index') }}"
                    class="px-4 py-2 bg-white text-gray-700 border rounded">
                    Cancelar
                </a>

                <button type="submit"
                    class="px-6 py-2 bg-olive-600 text-white rounded shadow hover:bg-olive-700">
                    Guardar producto
                </button>

            </div>

        </form>
    </div>

</div>

@endsection




