@extends('layouts.app')

@section('title', 'Editar Producto')

@section('content')

<h1 class="mb-4 text-3xl font-bold">Editar Producto</h1>

<div class="p-8 bg-white shadow-xl rounded-xl">


    <form action="{{ route('inventario.update', $producto->id) }}" 
          method="POST" enctype="multipart/form-data">

        @csrf
        @method('PUT')

        {{-- nombre --}}
        <label class="block mb-2 font-semibold">Nombre:</label>
        <input type="text" name="nombre" value="{{ $producto->nombre }}"
               class="w-full px-3 py-2 mb-4 border rounded" required>

        {{-- marca --}}
        <label class="block mb-2 font-semibold">Marca:</label>
        <select name="marca_id" class="w-full px-3 py-2 mb-4 border rounded" required>
            @foreach ($marcas as $marca)
                <option value="{{ $marca->id }}"
                    {{ $producto->marca_id == $marca->id ? 'selected' : '' }}>
                    {{ $marca->nombre }}
                </option>
            @endforeach
        </select>

        {{-- proveedor --}}
        <label class="block mb-2 font-semibold">Proveedor:</label>
        <select name="proveedor_id" class="w-full px-3 py-2 mb-4 border rounded" required>
            @foreach ($proveedores as $proveedor)
                <option value="{{ $proveedor->id }}"
                    {{ $producto->proveedor_id == $proveedor->id ? 'selected' : '' }}>
                    {{ $proveedor->nombre_empresa }}
                </option>
            @endforeach
        </select>

        {{-- checkbox talla --}}
        <label class="block mb-2 font-semibold">¿Usa talla?</label>
        <input type="checkbox" id="toggleTalla" onchange="mostrarTalla()"
               {{ $producto->talla ? 'checked' : '' }}>

        {{-- campo talla (solo se muestra si el producto tiene una) --}}
        <div id="campoTalla" class="{{ $producto->talla ? '' : 'hidden' }} mt-3">
            <label class="block mb-1 font-medium">Talla (opcional)</label>
            <input type="text" name="talla" value="{{ $producto->talla }}"
                   class="w-full px-3 py-2 border rounded">
        </div>

        {{-- existencia --}}
        <label class="block mt-4 mb-2 font-semibold">Existencia:</label>
        <input type="number" name="existencia" value="{{ $producto->existencia }}"
               class="w-full px-3 py-2 mb-4 border rounded" required>

        {{-- precio --}}
        <label class="block mb-2 font-semibold">Precio:</label>
        <input type="number" step="0.01" name="precio" value="{{ $producto->precio }}"
               class="w-full px-3 py-2 mb-4 border rounded" required>

        {{-- imagen actual --}}
        <label class="block mb-2 font-semibold">Imagen actual:</label>
        @if ($producto->imagen)
            <img src="{{ asset('storage/' . $producto->imagen) }}" class="w-32 mb-4 rounded">
        @else
            <p class="text-gray-500">Sin imagen</p>
        @endif

        {{-- subir nueva imagen --}}
        <label class="block mt-4 mb-2 font-semibold">Subir nueva imagen:</label>
        <input type="file" name="imagen" class="w-full px-3 py-2 mb-6 border rounded">

        {{-- boton para actualizar --}}
        <button class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
            Actualizar Producto
        </button>

    </form>

</div>

@endsection

{{-- script mostrar/ocultar talla --}}
<script>
function mostrarTalla() {
    document.getElementById('campoTalla')
        .classList.toggle('hidden', !document.getElementById('toggleTalla').checked);
}
</script>
