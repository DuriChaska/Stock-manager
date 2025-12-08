@extends('layouts.app')

@section('content')
<div class="p-6 space-y-6">

    <main class="flex-1 p-10">
                    
        <h2 class="text-3xl font-bold">Movimientos de Inventario</h2>
        <p class="text-gray-600">Registrar salida de unidades a tu inventario</p>

        <h2 class="mb-1 text-3xl font-bold text-center">Registro de salida de Stock</h2>
        <p class="mb-6 text-center text-gray-600">Registrar salida de unidades a tu inventario</p>

        <div class="p-10 bg-white border border-gray-200 shadow-lg rounded-2xl">

            <h3 class="flex items-center gap-3 mb-6 text-xl font-semibold">
                <span class="px-3 py-1 text-lg text-green-700 bg-green-100 rounded-full">+</span>
                Agregar Salida
            </h3>

            {{-- FORMULARIO --}}
            <form action="{{ route('movimientos.store') }}" method="POST">
                @csrf
                {{-- Indicamos que es una salida --}}
                <input type="hidden" name="tipo" value="salida">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Producto --}}
                    <div>
                        <label class="block mb-1 font-semibold">Producto</label>
                        <select name="producto_id" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                            <option value="">-- Selecciona un producto --</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }} @if($producto->talla) ({{ $producto->talla }}) @endif — stock: {{ $producto->existencia }}
                                </option>
                            @endforeach
                        </select>
                        @error('producto_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Proveedor --}}
                    <div>
                        <label class="block mb-1 font-semibold">Proveedor</label>
                        <select name="proveedor_id" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                            <option value="">-- Selecciona un proveedor --</option>
                            @foreach($proveedores as $prov)
                                <option value="{{ $prov->id }}" {{ old('proveedor_id') == $prov->id ? 'selected' : '' }}>
                                    {{ $prov->nombre_empresa }} — {{ $prov->nombre_contacto }}
                                </option>
                            @endforeach
                        </select>
                        @error('proveedor_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Marca (opcional) --}}
                    <div>
                        <label class="block mb-1 font-semibold">Marca (opcional)</label>
                        <input type="text" name="marca" value="{{ old('marca') }}" placeholder="Marca (se puede dejar vacío)"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                        @error('marca')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Costo unitario --}}
                    <div>
                        <label class="block mb-1 font-semibold">Costo unitario (MXN)</label>
                        <input type="number" name="costo" value="{{ old('costo') }}" step="0.01" min="0"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]" placeholder="0.00">
                        @error('costo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Cantidad --}}
                    <div>
                        <label class="block mb-1 font-semibold">Cantidad a retirar</label>
                        <input type="number" name="cantidad" value="{{ old('cantidad') }}" min="1"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]" placeholder="Ej. 3">
                        @error('cantidad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fecha --}}
                    <div>
                        <label class="block mb-1 font-semibold">Fecha</label>
                        <input type="date" name="fecha" value="{{ old('fecha', now()->toDateString()) }}"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-[#97BB5C]">
                        @error('fecha')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                 {{-- BOTONES --}}
                <div class="flex justify-between mt-10">

                {{-- Limpiar --}}
                <button type="reset"
                        class="px-6 py-3 text-gray-700 transition border border-gray-400 rounded-full hover:bg-gray-200">
                    Limpiar
                </button>

                <div class="flex gap-4">

                    {{-- Cancelar --}}
                    <a href="{{ route('movimientos.index') }}"
                       class="px-6 py-3 text-gray-700 transition border border-gray-400 rounded-full hover:bg-gray-200">
                        Cancelar
                    </a>

                    <button type="submit" 
                        class="flex items-center gap-2 px-8 py-2 text-black bg-[#97BB5C] rounded-full hover:bg-[#749646]">
                        <img src="{{ asset('images/savedisk_121993.png') }}" class="w-5 h-5" alt="Guardar">
                        Guardar Movimiento
                    </button>

                </div>
            </form>
        </div>

    </main>
</div>
@endsection
