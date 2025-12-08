@extends('layouts.app')

@section('title', 'Detalle del Proveedor')

@section('content')
    <h1 class="mb-4 text-2xl font-bold">Detalles del Proveedor</h1>

    <div class="p-4 bg-white shadow rounded-xl">

        <p><strong>Empresa:</strong> {{ $proveedor->nombre_empresa }}</p>
        <p><strong>Contacto:</strong> {{ $proveedor->nombre_contacto }}</p>
        <p><strong>Email:</strong> {{ $proveedor->email }}</p>
        <p><strong>Teléfono:</strong> {{ $proveedor->telefono }}</p>
        <p><strong>Dirección:</strong> {{ $proveedor->direccion }}</p>
        <p><strong>Descripción:</strong> {{ $proveedor->descripcion }}</p>

        <div class="flex gap-2 mt-4">
            <a href="{{ route('proveedores.index') }}" 
               class="px-4 py-2 text-black bg-gray-200 rounded-xl">
                Volver
            </a>

            <a href="{{ route('proveedores.edit', $proveedor) }}" 
               class="px-4 py-2 text-black bg-[#97BB5C] rounded-xl">
                Editar
            </a>
        </div>

    </div>
@endsection
