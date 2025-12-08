@extends('layouts.app')

@section('title','Nuevo Proveedor')

@section('content')
<div class="p-10">

    <h2 class="mb-1 text-3xl font-bold">Gestión de Proveedores</h2>
    <p class="mb-6 text-gray-600">Administra los Proveedores del sistema</p>

    <h2 class="mb-1 text-3xl font-bold text-center">Registro de Proveedores</h2>
    <p class="mb-6 text-center text-gray-600">Añade nuevos Proveedores al sistema</p>

    <div class="p-10 bg-white border border-gray-200 shadow-lg rounded-2xl">

         <h3 class="flex items-center gap-3 mb-6 text-xl font-semibold">
                <span class="px-3 py-1 text-lg text-green-700 bg-green-100 rounded-full">+</span>
                Agregar Proveedor
            </h3>

        <form action="{{ route('proveedores.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                <div>
                    <label class="font-semibold">Nombre de la Empresa</label>
                    <input type="text" name="nombre_empresa" value="{{ old('nombre_empresa') }}" 
                    class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                </div>

                <div>
                    <label class="font-semibold">Nombre del Contacto</label>
                    <input type="text" name="nombre_contacto" value="{{ old('nombre_contacto') }}"
                           class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                </div>

                <div>
                    <label class="font-semibold">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                </div>

                <div>
                    <label class="font-semibold">Teléfono</label>
                    <input type="text" name="telefono" value="{{ old('telefono') }}"
                           class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold">Dirección</label>
                    <input type="text" name="direccion" value="{{ old('direccion') }}"
                           class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                </div>

                <div class="md:col-span-2">
                    <label class="font-semibold">Descripción</label>
                    <textarea name="descripcion"
                              class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">{{ old('descripcion') }}</textarea>
                </div>

            </div>

            <div class="flex justify-end gap-4 mt-10">
                    <button type="reset" class="px-6 py-2 bg-gray-100 rounded-xl hover:bg-gray-200">Limpiar</button>

                    <a href="{{ route('proveedores.index') }}" class="px-6 py-2 bg-gray-100 rounded-xl hover:bg-gray-200">Cancelar</a>

                    <button type="submit" class="flex items-center gap-2 px-8 py-2 text-white bg-green-600 rounded-xl hover:bg-green-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Proveedor
                    </button>
                </div>

        </form>

    </div>

</div>
@endsection
