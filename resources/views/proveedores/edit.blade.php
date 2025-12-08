@extends('layouts.app')

@section('title','Editar Proveedor')

@section('content')
<div class="container p-6 mx-auto">
  <h1 class="mb-4 text-2xl font-bold">Editar Proveedor</h1>

  @if($errors->any())
    <div class="p-4 mb-4 text-red-800 bg-red-100 rounded">
      <ul class="pl-5 list-disc">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('proveedores.update', $proveedor) }}" method="POST" class="space-y-4">
    @method('PUT')
    @csrf

    <div>
      <label class="block font-medium">Nombre de la Empresa</label>
      <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa', $proveedor->nombre_empresa) }}" class="w-full px-3 py-2 border rounded" required>
    </div>

    <div>
      <label class="block font-medium">Nombre del Contacto</label>
      <input type="text" name="nombre_contacto" value="{{ old('nombre_contacto', $proveedor->nombre_contacto) }}" class="w-full px-3 py-2 border rounded" required>
    </div>

    <div>
      <label class="block font-medium">Email</label>
      <input type="email" name="email" value="{{ old('email', $proveedor->email) }}" class="w-full px-3 py-2 border rounded">
    </div>

    <div>
      <label class="block font-medium">Teléfono</label>
      <input type="text" name="telefono" value="{{ old('telefono', $proveedor->telefono) }}" class="w-full px-3 py-2 border rounded">
    </div>

    <div>
      <label class="block font-medium">Dirección</label>
      <input type="text" name="direccion" value="{{ old('direccion', $proveedor->direccion) }}" class="w-full px-3 py-2 border rounded">
    </div>

    <div>
      <label class="block font-medium">Descripción</label>
      <textarea name="descripcion" class="w-full px-3 py-2 border rounded">{{ old('descripcion', $proveedor->descripcion) }}</textarea>
    </div>

    <div class="flex space-x-2">
      <button type="submit" class="px-4 py-2 text-black bg-[#97BB5C] rounded-xl">Actualizar</button>
      <a href="{{ route('proveedores.index') }}" class="px-4 py-2 text-black bg-gray-300 border rounded-xl">Cancelar</a>
    </div>
  </form>
</div>
@endsection
