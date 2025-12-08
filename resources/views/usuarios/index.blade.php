@extends('layouts.app')

@section('content')
<div class="p-6">

    <h1 class="mb-1 text-4xl font-bold">Usuarios</h1>
    <p class="mb-8 text-gray-600">Administra los usuarios del sistema</p>

    {{-- CONTENEDOR PRINCIPAL --}}
    <div class="p-8 bg-white shadow-xl rounded-3xl">

        {{-- Encabezado de tabla --}}
        <div class="grid grid-cols-6 pb-3 font-semibold text-gray-600 border-b">

            <div class="flex items-center gap-2">
                <img src="/images/users_89368.png" class="w-5">
                Usuarios
            </div>

            <div class="col-span-2">Correo Electrónico</div>
            <div>Rol</div>
            <div>Actividad</div>
            <div>Acciones</div>
        </div>

        {{-- LISTADO --}}
        <div class="divide-y">

            @foreach ($users as $user)

            <div class="grid items-center grid-cols-6 py-4">

                {{-- Usuario + Iniciales --}}
                <div class="flex items-center gap-4">

                    {{-- Círculo con iniciales --}}
                    <div class="w-10 h-13 rounded-full bg-[#cfe3a4] flex items-center justify-center font-bold text-gray-700">
                        {{ strtoupper(substr($user->name, 0, 2)) }}
                    </div>

                    <p class="text-sm text-gray-500">
                        Último acceso: {{ $user->lastSeenHuman() }}
                    </p>

                </div>

                {{-- Email --}}
                <div class="col-span-2 text-gray-700">
                    {{ $user->email }}
                </div>

    <div>
    @php
        // Función anónima (NO se redeclara)
        $normalizar = function($cadena) {
            $cadena = strtolower($cadena);
            return str_replace(
                ['á','é','í','ó','ú','ñ'],
                ['a','e','i','o','u','n'],
                $cadena
            );
        };

        // Obtener rol normalizado y rol original
        $rolOriginal = $user->rol->name ?? 'Sin Rol';
        $rol = $normalizar($rolOriginal);

        // Colores por rol
        $colores = [
            'administrador' => 'bg-[#B6EA60] text-black',
            'vendedor'      => 'bg-[#19C827] text-white',
            'almacen'       => 'bg-[#0AA617] text-white',
        ];

        // Iconos por rol (tú colocas tus imágenes)
        $iconos = [
            'administrador' => '/images/shield_icon_125161.png',
            'vendedor'      => '/images/4105931-add-to-cart-buy-cart-sell-shop-shopping-cart_113919.png',
            'almacen'       => '/images/wondicon-ui-free-parcel_111208.png',
        ];

        // Asignar color e icono
        $color = $colores[$rol] ?? 'bg-gray-300 text-gray-800';
        $icono = $iconos[$rol] ?? '/images/icon-default.png';
    @endphp

    <span class="px-4 py-1 rounded-full shadow text-sm flex-1 items-center gap-2 {{ $color }}">
        <img src="{{ $icono }}" class="w-4 h-4" alt="icono {{ $rolOriginal }}">
        {{ $rolOriginal }}
    </span>
</div>


                {{-- Actividad (siempre activo por ahora) --}}
                <div>
                    <span class="items-center flex-1 gap-1 px-4 py-1 text-sm text-green-700 bg-green-200 rounded-full">
                        ● Activo
                    </span>
                </div>

                {{-- ACCIONES --}}
                <div class="flex gap-4">

                    {{-- Editar --}}
                    <a href="{{ route('usuarios.edit', $user->id) }}" class="transition hover:scale-110">
                        <img src="/images/pencil_icon.png" class="w-5">
                    </a>

                    {{-- Eliminar --}}
                    <form action="{{ route('usuarios.destroy', $user->id) }}" method="POST"
                          onsubmit="return confirm('¿Seguro que deseas eliminar este usuario?')">
                        @csrf
                        @method('DELETE')

                        <button class="transition hover:scale-110">
                            <img src="/images/trash_icon.png" class="w-5">
                        </button>
                    </form>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</div>
@endsection
