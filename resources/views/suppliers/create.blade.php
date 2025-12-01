@extends('layouts.app')

@section('title','Nuevo Proveedor')

@section('content')
<div class="container mx-auto p-6">
  <h1 class="text-2xl font-bold mb-4">Agregar Proveedor</h1>

  @if($errors->any())
    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
      <ul class="list-disc pl-5">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4">
    @csrf

    <div>
      <label class="block font-medium">Empresa (Company name)</label>
      <input type="text" name="company_name" value="{{ old('company_name') }}" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
      <label class="block font-medium">Contacto (Contact name)</label>
      <input type="text" name="contact_name" value="{{ old('contact_name') }}" class="w-full border px-3 py-2 rounded" required>
    </div>

    <div>
      <label class="block font-medium">Email</label>
      <input type="email" name="email" value="{{ old('email') }}" class="w-full border px-3 py-2 rounded">
    </div>

    <div>
      <label class="block font-medium">Teléfono</label>
      <input type="text" name="phone" value="{{ old('phone') }}" class="w-full border px-3 py-2 rounded">
    </div>

    <div>
      <label class="block font-medium">Dirección</label>
      <input type="text" name="address" value="{{ old('address') }}" class="w-full border px-3 py-2 rounded">
    </div>

    <div>
      <label class="block font-medium">Descripción</label>
      <textarea name="description" class="w-full border px-3 py-2 rounded">{{ old('description') }}</textarea>
    </div>

    <div class="flex space-x-2">
      <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Guardar</button>
      <a href="{{ route('suppliers.index') }}" class="text-gray-600 px-4 py-2 rounded border">Cancelar</a>
    </div>
  </form>
</div>
@endsection
