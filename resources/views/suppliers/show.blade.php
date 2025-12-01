@extends('layouts.app')

@section('title', 'Detalle del Proveedor')

@section('content')
    <h1 class="text-2xl font-bold mb-4">Detalles del Proveedor</h1>

    <div class="bg-white shadow rounded p-4">

        <p><strong>Empresa:</strong> {{ $supplier->company_name }}</p>
        <p><strong>Contacto:</strong> {{ $supplier->contact_name }}</p>
        <p><strong>Email:</strong> {{ $supplier->email }}</p>
        <p><strong>Teléfono:</strong> {{ $supplier->phone }}</p>
        <p><strong>Dirección:</strong> {{ $supplier->address }}</p>
        <p><strong>Descripción:</strong> {{ $supplier->description }}</p>

        <div class="mt-4 flex gap-2">
            <a href="{{ route('suppliers.index') }}" 
               class="bg-gray-500 text-white px-4 py-2 rounded">
                Volver
            </a>

            <a href="{{ route('suppliers.edit', $supplier) }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded">
                Editar
            </a>
        </div>

    </div>
@endsection
