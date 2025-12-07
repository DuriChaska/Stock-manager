@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
    <div class="container">
        <h1>Listado de Productos</h1>
        
        {{-- Aquí iría un botón para crear un nuevo producto --}}
        <a href="{{ route('productos.create') }}" class="btn btn-primary">Crear Nuevo Producto</a>
        
        {{-- Aquí se mostraría la tabla con los productos --}}
        <p>Tabla de productos...</p>
        
        {{-- En un paso posterior, iterarías sobre los productos: --}}
        {{-- @foreach ($productos as $producto) --}}
            {{-- ... mostrar datos del producto ... --}}
        {{-- @endforeach --}}
    </div>
@endsection