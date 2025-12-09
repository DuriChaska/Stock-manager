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

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            <!-- Nombre -->
            <div>
                <label class="block mb-1 font-medium">Nombre del producto *</label>
                <input type="text" name="nombre"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                       required>
            </div>

            <!-- Marca -->
            <div>
                <label class="font-medium">Marca *</label>
                <select name="marca_id"
                    class="w-full px-4 py-2 text-black bg-white border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                    required>
                    <option value="">Seleccione Marca</option>

                    @foreach ($marcas as $marca)
                        <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Proveedor -->
            <div>
                <label class="font-medium">Proveedor *</label>
                <select name="proveedor_id"
                    class="w-full px-4 py-2 text-black bg-white border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                    required>
                    <option value="">Seleccione Proveedor</option>

                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_empresa }}</option>
                    @endforeach
                </select>
                
            </div>

            <!-- Precio -->
            <div>
                <label class="font-medium">Precio *</label>
                <input type="number" step="0.01" name="precio"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                       required>
            </div>

            <!-- Stock -->
            <div>
                <label class="font-medium">Stock inicial *</label>
                <input type="number" name="existencia"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                       required>
            </div>

            <!-- Activar talla -->
            <div>
                <label class="font-medium">¿Usa talla?</label>

                <div class="flex items-center gap-2 mt-1">
                    <input type="checkbox" id="toggleTalla" onchange="mostrarTalla()"
                           class="w-5 h-5 text-green-600 cursor-pointer">
                    <span class="text-gray-600">Este producto maneja tallas</span>
                </div>
            </div>

            <!-- Campo talla (oculto por defecto) -->
            <div id="campoTalla" class="hidden">
                <label class="block mb-1 font-medium">Talla (opcional)</label>
                <input type="text" name="talla"
                       placeholder="Ej: M, 32, 500ml, 7"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400">
            </div>

            <!-- Imagen -->
            <div class="col-span-2">
                <label class="font-medium">Imagen del producto</label>
                <input type="file" name="imagen"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400">
            </div>

        </div>

        {{-- Botones --}}
        <div class="flex justify-between mt-10">

            <button type="reset"
                    class="px-6 py-3 text-gray-700 border rounded-full hover:bg-gray-200">
                Limpiar
            </button>

            <div class="flex gap-4">
                <a href="{{ route('inventario.index') }}"
                   class="px-6 py-3 text-gray-700 border rounded-full hover:bg-gray-200">
                    Cancelar
                </a>

                <button type="submit" 
                        class="flex items-center gap-2 px-8 py-2 text-black bg-[#97BB5C] rounded-full hover:bg-[#749646]">
                    <img src="{{ asset('images/savedisk_121993.png') }}" class="w-5">
                    Guardar Producto
                </button>
            </div>
        </div>

    </form>

</div>

@endsection

<script>
function mostrarTalla() {
    const chk = document.getElementById('toggleTalla');
    const campo = document.getElementById('campoTalla');
    campo.classList.toggle('hidden', !chk.checked);
}
</script>
