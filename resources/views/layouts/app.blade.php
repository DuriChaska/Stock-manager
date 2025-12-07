<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Stock Managger') }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo-nav.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="flex min-h-screen bg-white">

    {{-- SIDEBAR --}}
    <aside class="fixed h-full text-black transition-all duration-300 bg-white shadow w-60">
        <div class="p-6 text-xl font-bold text-center border-b border-gray-700">
            <img src="/images/logo-nav.png" class="w-12 mx-auto mb-2" alt="Logo">
            STOCK MANAGGER
        </div>

        <nav class="mt-6">
            <ul class="space-y-1">

                {{-- Dashboard --}}
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition
                        {{ request()->routeIs('dashboard') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/dashboard_icon_221153.png" class="w-5">
                        <span>Dashboard</span>
                    </a>
                </li>

                {{-- Productos --}}
                <li>
                    <a href="{{ route('productos.index') }}"
                        class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition
                        {{ request()->routeIs('productos.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/wondicon-ui-free-parcel_111208.png" class="w-5">
                        <span>Inventario</span>
                    </a>
                </li>

                {{-- Ventas --}}
                <li>
                    <a href="{{ route('movimientos.index') }}"
                        class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition
                        {{ request()->routeIs('movimientos.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/arrow_data_transfer_vertical_sync_icon_183025.png" class="w-5">
                        <span>Movimientos</span>
                    </a>
                </li>

                {{-- Proveedores --}}
                <li>
                    <a href="{{ route('proveedores.index') }}"
                        class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition
                        {{ request()->routeIs('proveedores.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/graphical-business-presentation-on-a-screen_icon-icons.com_73240.png" class="w-5">
                        <span>Reportes</span>
                    </a>
                </li>
                
                {{-- Proveedores --}}
                <li>
                    <a href="{{ route('proveedores.index') }}"
                        class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition
                        {{ request()->routeIs('proveedores.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/4105943-accounts-group-people-user-user-group-users_113923.png" class="w-5">
                        <span>Usuarios</span>
                    </a>
                </li>
                
                {{-- Proveedores --}}
                <li>
                    <a href="{{ route('proveedores.index') }}"
                        class="flex items-center gap-3 px-6 py-3 hover:bg-[#97BB5C] transition
                        {{ request()->routeIs('proveedores.*') ? 'bg-[#97BB5C]' : '' }}">
                        <img src="/images/descargar (5).png" class="w-5">
                        <span>Proveedores</span>
                    </a>
                </li>

            </ul>
        </nav>
    </aside>

    {{-- CONTENIDO --}}
    <div class="flex-1 ml-60">
        @include('layouts.navigation')

        @isset($header)
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main class="p-6">
            {{ $slot ?? '' }}
            @yield('content')
        </main>
    </div>

</div>
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
