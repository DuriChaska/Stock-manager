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
            
            <div class="flex flex-col">
                
                <div class="flex flex-col items-center mb-6">
                    <img 
                        src="{{ asset('images/logo.png') }}" 
                        alt="Logo de Stock Managger" 
                        class="object-contain w-40 h-40" 
                    >
                </div>

                <div class="max-w-sm mx-auto mb-6 text-center">
                    <h2 class="mb-2 text-xl font-bold">¡Bienvenido!</h2>
                    <p class="text-sm text-lime-100">
                        Queremos que usando STOCK MANAGGER potencies tu negocio y obtengas mejores resultados. Para comenzar a usar nuestra herramienta, completa el formulario de registro.
                    </p>
                </div>
                
                <form method="POST" action="{{ route('register') }}" class="w-full max-w-sm mx-auto">
                    @csrf
                    
                    <div class="mb-6 border-b border-white border-opacity-50">
                        <input 
                            type="text" 
                            id="name" 
                            name="name" 
                            placeholder="Nombre" 
                            value="{{ old('name') }}"
                            required autofocus autocomplete="name"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('name')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 border-b border-white border-opacity-50">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            placeholder="Correo electrónico" 
                            value="{{ old('email') }}"
                            required autocomplete="username"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('email')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 border-b border-white border-opacity-50">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            placeholder="Contraseña"
                            required autocomplete="new-password"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('password')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-6 border-b border-white border-opacity-50">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            placeholder="Confirmar Contraseña"
                            required autocomplete="new-password"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('password_confirmation')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mb-6 border-b border-white border-opacity-50">
                        <input 
                            type="text" 
                            id="celular" 
                            name="celular" 
                            placeholder="Celular" 
                            value="{{ old('celular') }}"
                            class="w-full py-1 text-white placeholder-white bg-transparent border-b border-transparent focus:outline-none focus:border-white placeholder-opacity-70"
                        />
                        @error('celular')
                            <p class="mt-1 text-xs text-red-200">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center mt-4">
                        <input id="terms" type="checkbox" name="terms" required class="rounded border-gray-300 shadow-sm text-[#51A424] focus:ring-[#51A424]">
                        <label for="terms" class="text-sm text-white ms-2">Acepta nuestros <a href="#" class="font-bold underline">términos y condiciones</a></label>
                    </div>

                    <div class="flex justify-center pt-8">
                        <button type="submit" class="inline-block bg-[#51A424] hover:bg-[#46901F] text-white font-medium py-2 px-8 rounded-full transition duration-300 shadow-lg">
                            ¡Regístrate!
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="flex flex-col items-center justify-center w-full p-10 text-gray-800 bg-white lg:w-1/2">
            
            <div class="max-w-sm mb-16">
                 <img src="{{ asset('images/imagen-registro.png') }}" alt="Ilustración de Stock Managger con monitor" class="object-contain" > 
                </div>
            
            <div class="text-center">
                <p class="mb-4 text-xl font-semibold text-gray-600">
                    ¿Ya estás registrado?
                </p>
                <a 
                    href="{{ route('login') }}" 
                    class="inline-block bg-[#51A424] hover:bg-[#46901F] text-white font-medium py-2 px-8 rounded-full transition duration-300 shadow-lg">
                    Iniciar sesión
                </a>
            </div>

        </div>
    </div>

</body>
</html>