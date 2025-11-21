<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Stock Managger') }}</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js']) 
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">

    <div class="flex w-full max-w-6xl overflow-hidden rounded-lg shadow-2xl">
        
        <div class="w-full lg:w-1/2 p-10 flex flex-col justify-between bg-[#97BB5C] text-white min-h-[500px]">
            
            <div class="flex flex-col flex-grow">
                
                <div class="flex flex-col items-center pt-6 mb-8">
                    <img 
                        src="{{ asset('images/logo.png') }}" 
                        alt="Logo de Stock Managger" 
                        class="object-contain w-48 h-48" 
                    >
                </div>
                
                <form method="POST" action="{{ route('login') }}" class="flex flex-col justify-center flex-grow w-full max-w-sm mx-auto">
                    @csrf

                    @if (session('status'))
                        <div class="p-2 mb-4 text-sm font-medium text-center text-white rounded bg-lime-700/50">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    <div class="mb-8 border-b border-white border-opacity-50">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Correo electrónico" 
                            value="{{ old('email') }}"
                            required autofocus autocomplete="username"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('email')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-8 border-b border-white border-opacity-50">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Contraseña"
                            required autocomplete="current-password"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('password')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="flex items-center justify-between mb-4 text-sm">
                        <label for="remember_me" class="inline-flex items-center text-white text-opacity-70">
                            <input id="remember_me" type="checkbox" name="remember" class="border-gray-300 rounded shadow-sm text-lime-800 focus:ring-lime-700">
                            <span class="ms-2">Recuérdame</span>
                        </label>
                        
                        @if (Route::has('password.request'))
                            <a class="text-white underline text-opacity-70 hover:text-white" href="{{ route('password.request') }}">
                                ¿Olvidaste tu contraseña?
                            </a>
                        @endif
                    </div>

                    <div class="flex justify-center pt-4">
                        <button type="submit" class="inline-block bg-[#51A424] hover:bg-[#46901F] text-white font-medium py-2 px-6 rounded-full transition duration-300 shadow-lg">
                            Iniciar sesión
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="mt-10 text-center">
                <p class="mb-3 text-sm text-lime-100">¿Aún no estás registrado?</p>
                @if (Route::has('register'))
                    <a 
                        href="{{ route('register') }}" 
                        class="inline-block px-6 py-2 font-bold transition duration-300 bg-white rounded-full shadow-md text-lime-700 hover:bg-gray-100">
                        ¡Regístrate!
                    </a>
                @endif
            </div>

        </div>

        <div class="flex flex-col items-center justify-center w-full p-10 text-gray-800 bg-white lg:w-1/2">
            
            <div class="max-w-sm mb-8">
                 <img src="{{ asset('images/imagen-login.png') }}" alt="Ilustración de Stock Managger" class="object-contain w-50 h-50" >
            </div>
            
            <div class="text-center">
                <p class="mb-4 text-xl font-semibold">
                    Obtén un mejor control de tu empresa con 
                    <span class="font-bold text-lime-600">STOCK MANAGGER</span>
                </p>
                <p class="text-base text-gray-600">
                    ¡Inicia sesión para empezar!
                </p>
            </div>

        </div>
    </div>

</body>
</html>