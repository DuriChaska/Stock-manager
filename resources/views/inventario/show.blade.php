@extends('layouts.app')

@section('title', 'Detalle del Producto')

@section('content')

<h1 class="mb-6 text-3xl font-bold">Detalle del Producto</h1>

<div class="p-6 bg-white shadow rounded-xl">
    
    <h2 class="mb-4 text-2xl font-bold">{{ $producto->nombre }}</h2>

    <p><strong>Marca:</strong> {{ $producto->marca->nombre ?? 'Sin marca' }}</p>
    <p><strong>Proveedor:</strong> {{ $producto->proveedor->nombre_empresa ?? 'Sin proveedor' }}</p>
    <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
    <p><strong>Existencia:</strong> {{ $producto->existencia }}</p>

    @if($producto->imagen)
        <img src="{{ asset('storage/' . $producto->imagen) }}" class="w-40 mt-4 rounded">
    @endif

    <a href="{{ route('inventario.index') }}"
       class="inline-block px-6 py-2 mt-6 bg-gray-300 rounded hover:bg-gray-400">
        Volver
    </a>

</div>

@endsection
