<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100">

    <div class="flex">

        {{-- Sidebar --}}
        @include('layouts.sidebar')

        <div class="flex-1">

            {{-- Topbar --}}
            @include('layouts.topbar')

            {{-- Contenido --}}
            <main class="p-6">
                @yield('content')
            </main>

        </div>
    </div>

</body>
</html>