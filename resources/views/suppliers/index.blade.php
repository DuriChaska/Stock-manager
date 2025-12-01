@extends('layouts.app')

@section('title','Proveedores')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Gestión de Proveedores</h1>

  {{-- Mensajes --}}
  @if(session('success'))
    <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
      {{ session('success') }}
    </div>
  @endif

  <div class="flex justify-between mb-4">
    <form action="{{ route('suppliers.index') }}" method="GET" class="w-full max-w-md flex">
      <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar por nombre, empresa o email…" class="w-full border rounded-l px-3 py-2">
      <button type="submit" class="bg-blue-600 text-white px-4 rounded-r">Buscar</button>
    </form>

    <a href="{{ route('suppliers.create') }}" class="bg-green-600 text-white px-4 py-2 rounded">+ Agregar Proveedor</a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($suppliers as $supplier)
      <div class="bg-white p-4 rounded shadow">
        <h2 class="text-xl font-semibold">{{ $supplier->company_name }}</h2>
        <p class="text-gray-700">{{ $supplier->contact_name }}</p>
        @if($supplier->email)
          <p class="text-sm text-gray-600">✉️ {{ $supplier->email }}</p>
        @endif
        @if($supplier->phone)
          <p class="text-sm text-gray-600">📞 {{ $supplier->phone }}</p>
        @endif
        @if($supplier->address)
          <p class="text-sm text-gray-600">🏠 {{ $supplier->address }}</p>
        @endif
        <p class="text-gray-600 mt-2">{{ Str::limit($supplier->description, 100) }}</p>

        <div class="mt-4 flex space-x-2">
          <a href="{{ route('suppliers.edit', $supplier) }}" class="text-blue-600">Editar</a>

          <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('¿Eliminar proveedor?');" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-600">Eliminar</button>
          </form>

          <a href="{{ route('suppliers.show', $supplier) }}" class="text-gray-600">Ver</a>
        </div>
      </div>
    @endforeach
  </div>

  <div class="mt-6">
    {{ $suppliers->links() }}
  </div>
</div>
@endsection
