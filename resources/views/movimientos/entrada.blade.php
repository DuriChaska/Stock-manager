@extends('layouts.app')

@section('content')
<div class="flex w-full">

    {{-- SIDEBAR --}}
    <aside class="w-64 min-h-screen p-6 bg-white shadow-md">
        <div class="flex items-center gap-2 text-xl font-semibold">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="object-contain mt-10 w-28 h-28">
            STOCK MANAGER
        </div>

        <nav class="mt-8 space-y-4">
            <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                <img src="{{ asset('images/dashboard_icon_221153.png') }}" class="w-6 h-6" alt="">
                Dashboard
            </a>
            <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                <img src="{{ asset('images/wondicon-ui-free-parcel_111208.png') }}" class="w-6 h-6" alt="">
                Inventario
            </a>

            <a href="{{ route('movimientos.index') }}" class="flex items-center gap-2 px-3 py-2 font-semibold text-green-900 bg-green-200 rounded-md">
                <img src="{{ asset('images/arrow_data_transfer_vertical_sync_icon_183025.png') }}" class="w-4 h-4" alt="">
                Movimientos
            </a>

            <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                <img src="{{ asset('images/graphical-business-presentation-on-a-screen_icon-icons.com_73240.png') }}" class="w-4 h-4" alt="">
                Reportes
            </a>

            <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                <img src="{{ asset('images/4105943-accounts-group-people-user-user-group-users_113923.png') }}" class="w-4 h-4" alt="">
                Usuarios
            </a>

            <a href="#" class="flex items-center gap-2 text-gray-700 hover:text-green-600">
                <img src="{{ asset('images/descargar (5).png') }}" class="w-4 h-4" alt="">
                Proveedores
            </a>
        </nav>
    </aside>

    {{-- CONTENIDO --}}
    <main class="flex-1 p-10">

        {{-- Top bar --}}
        <div class="flex items-center justify-between w-full pb-6">
            <div class="w-full md:w-1/3">
                <div class="relative">
                    <svg class="absolute w-5 h-5 text-gray-400 left-3 top-2.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.197 5.197a7.5 7.5 0 0 0 10.606 10.606Z" />
                    </svg>
                    <input type="text" placeholder="Buscar" class="w-full py-2 pl-10 pr-4 border border-gray-300 rounded-full focus:ring-2 focus:ring-green-400">
                </div>
            </div>

            <div class="flex items-center gap-6">
                <img src="{{ asset('images/notification_time_bell_alert_alarm_icon_220036.png') }}" class="w-6 h-6" alt="">
                <img src="{{ asset('images/user_man_accept_21961.png') }}" class="w-6 h-6" alt="">
            </div>
        </div>

        <h2 class="mt-10 text-3xl font-bold">Movimientos de Inventario</h2>
        <p class="mb-6 text-gray-600">Registrar entrada de unidades a tu inventario</p>

        <div class="p-10 bg-white border border-gray-200 shadow-lg rounded-2xl">

            <h3 class="flex items-center gap-3 mb-6 text-xl font-semibold">
                <span class="px-3 py-1 text-lg text-green-700 bg-green-100 rounded-full">+</span>
                Agregar Entrada
            </h3>

            {{-- FORMULARIO --}}
            <form action="{{ route('movimientos.store') }}" method="POST">
                @csrf
                {{-- Indicamos que es una entrada --}}
                <input type="hidden" name="tipo" value="entrada">

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    {{-- Producto --}}
                    <div>
                        <label class="block mb-1 font-semibold">Producto</label>
                        <select name="producto_id" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-400">
                            <option value="">-- Selecciona un producto --</option>
                            @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>
                                    {{ $producto->nombre }} @if($producto->talla) ({{ $producto->talla }}) @endif
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
                        <select name="proveedor_id" class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-400">
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

                    {{-- Marca (se muestra como texto, opcional) --}}
                    <div>
                        <label class="block mb-1 font-semibold">Marca (opcional)</label>
                        <input type="text" name="marca" value="{{ old('marca') }}" placeholder="Marca (se puede dejar vacío)"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-400">
                        @error('marca')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Costo unitario --}}
                    <div>
                        <label class="block mb-1 font-semibold">Costo unitario (MXN)</label>
                        <input type="number" name="costo" value="{{ old('costo') }}" step="0.01" min="0"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-400" placeholder="0.00">
                        @error('costo')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Cantidad --}}
                    <div>
                        <label class="block mb-1 font-semibold">Cantidad a ingresar</label>
                        <input type="number" name="cantidad" value="{{ old('cantidad') }}" min="1"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-400" placeholder="Ej. 10">
                        @error('cantidad')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Fecha --}}
                    <div>
                        <label class="block mb-1 font-semibold">Fecha de entrada</label>
                        <input type="date" name="fecha" value="{{ old('fecha', now()->toDateString()) }}"
                               class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-green-400">
                        @error('fecha')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex justify-end gap-4 mt-10">
                    <button type="reset" class="px-6 py-2 bg-gray-100 rounded-xl hover:bg-gray-200">Limpiar</button>

                    <a href="{{ route('movimientos.index') }}" class="px-6 py-2 bg-gray-100 rounded-xl hover:bg-gray-200">Cancelar</a>

                    <button type="submit" class="flex items-center gap-2 px-8 py-2 text-white bg-green-600 rounded-xl hover:bg-green-700">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Guardar Movimiento
                    </button>
                </div>
            </form>
        </div>

    </main>
</div>
@endsection
