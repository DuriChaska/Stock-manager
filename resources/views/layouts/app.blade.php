<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stock Manager') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-nav.png') }}">


    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

    

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">

<div class="flex min-h-screen">

    {{-- 🔵 SIDEBAR --}}
    <aside class="fixed h-full transition-all duration-300 bg-white shadow w-60">
        <div class="p-6 text-xl font-bold text-center border-b">
            <img src="/images/logo-nav.png" class="w-12 mx-auto mb-2" alt="Logo">
            STOCK MANAGGER
        </div>

        <nav class="mt-6">
            <ul class="space-y-1">


                <li>
                    <a href="{{ route('dashboard') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition rounded-full
                       {{ request()->routeIs('dashboard') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/dashboard_icon_221153.png" class="w-5">
                        <span>Dashboard</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('inventario.index') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition rounded-full
                       {{ request()->routeIs('inventario.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/wondicon-ui-free-parcel_111208.png" class="w-5">
                        <span>Inventario</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('movimientos.index') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition rounded-full
                       {{ request()->routeIs('movimientos.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/arrow_data_transfer_vertical_sync_icon_183025.png" class="w-5">
                        <span>Movimientos</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('reportes.index') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition rounded-full
                       {{ request()->routeIs('reportes.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/graphical-business-presentation-on-a-screen_icon-icons.com_73240.png" class="w-5">
                        <span>Reportes</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('usuarios.index') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition rounded-full
                       {{ request()->routeIs('usuarios.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/4105943-accounts-group-people-user-user-group-users_113923.png" class="w-5">
                        <span>Usuarios</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('proveedores.index') }}"
                       class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition rounded-full
                       {{ request()->routeIs('proveedores.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/descargar (5).png" class="w-5">
                        <span>Proveedores</span>
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    {{-- 🔵 CONTENIDO --}}
    <div class="flex-1 ml-60">

        {{-- 🔵 TOPBAR --}}
        <div class="flex items-center justify-between p-4 bg-white shadow">

            {{-- 🔍 Buscador --}}
            <div class="relative flex items-center w-full max-w-3xl px-4 py-2 bg-white border rounded-full shadow-sm">
                <input id="searchInput" type="text" placeholder="Buscar productos..." class="flex-1 text-sm bg-transparent outline-none">
                <img src="{{ asset('images/3844432-magnifier-search-zoom_110300.png') }}" alt="Buscar" class="w-5 h-5 ml-2 cursor-pointer opacity-70 hover:opacity-100" />
                <div id="resultBox" class="absolute left-0 z-50 w-full mt-1 bg-white rounded shadow-lg top-full"></div>
            </div>

            {{-- 🔔 Campana + Perfil --}}
            <div class="flex items-center gap-6">
                @include('layouts.navigation')
                
            </div>

        </div>

        {{-- 🔵 CONTENIDO DE LA PÁGINA --}}
        <main class="p-6">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

    </div>

</div>


{{-- 🔵 SCRIPT DEL BUSCADOR --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.querySelector('#searchInput');
    const resultBox = document.querySelector('#resultBox');

    function buscar() {
        const q = searchInput.value;
        if (q.length < 2) {
            resultBox.innerHTML = '';
            return;
        }

        fetch(`/buscar-productos?q=${q}`)
            .then(res => res.json())
            .then(data => {
                resultBox.innerHTML = data.map(p =>
                    `<a href="/productos/${p.id}" class="block px-3 py-2 hover:bg-gray-100">${p.nombre}</a>`
                ).join('');
            });
    }

    searchInput.addEventListener('input', buscar);
});
</script>


</body>
</html>
