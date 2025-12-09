@extends('layouts.app')

@section('title', 'Perfil')

@section('content')

<div class="max-w-4xl mx-auto mt-10">

    <!-- Encabezado del perfil -->
    <div class="flex items-center gap-6 p-6 mb-10 bg-white shadow rounded-xl">
        
        <!-- Avatar gigante -->
        <div class="w-20 h-20 flex items-center justify-center rounded-full text-white text-3xl font-bold
                    bg-gradient-to-br from-[#97BB5C] to-[#749646] shadow">
            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
        </div>

        <div>
            <h1 class="text-3xl font-bold text-gray-800">{{ Auth::user()->name }}</h1>
            <p class="text-gray-500">{{ Auth::user()->email }}</p>
        </div>

    </div>


    <!-- Actualizar Datos Personales -->
    <div class="p-6 mb-10 bg-white shadow rounded-xl">

        <h2 class="mb-4 text-xl font-semibold text-gray-700">Información Personal</h2>

        <form method="POST" action="{{ route('profile.update') }}" class="space-y-5">
            @csrf
            @method('PATCH')

            <!-- Nombre -->
            <div>
                <label class="font-medium text-gray-600">Nombre</label>
                <input type="text" name="name" value="{{ old('name', Auth::user()->name) }}"
                       class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Correo -->
            <div>
                <label class="font-medium text-gray-600">Correo electrónico</label>
                <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}"
                       class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <!-- Botón -->
            <button class="px-6 py-2 bg-[#749646] text-white rounded-lg shadow hover:bg-[#5f7c38] transition">
                Guardar Cambios
            </button>
        </form>
    </div>


    <!-- Cambiar Contraseña -->
    <div class="p-6 mb-10 bg-white shadow rounded-xl">

        <h2 class="mb-4 text-xl font-semibold text-gray-700">Cambiar Contraseña</h2>

        <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="font-medium text-gray-600">Contraseña Actual</label>
                <input type="password" name="current_password"
                       class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="font-medium text-gray-600">Nueva Contraseña</label>
                <input type="password" name="password"
                       class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <div>
                <label class="font-medium text-gray-600">Confirmar Contraseña</label>
                <input type="password" name="password_confirmation"
                       class="w-full px-4 py-2 mt-1 border rounded-lg shadow-sm focus:ring-green-500 focus:border-green-500">
            </div>

            <button class="px-6 py-2 bg-[#749646] text-white rounded-lg shadow hover:bg-[#5f7c38] transition">
                Actualizar Contraseña
            </button>
        </form>
    </div>


    <!-- Eliminar Cuenta -->
    <div class="p-6 bg-white shadow rounded-xl">

        <h2 class="mb-4 text-xl font-semibold text-red-600">Eliminar Cuenta</h2>

        <p class="mb-4 text-gray-600">
            Una vez eliminada tu cuenta, todos los datos serán eliminados permanentemente.
            Esta acción no se puede deshacer.
        </p>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <button class="px-6 py-2 text-white transition bg-red-600 rounded-lg shadow hover:bg-red-700">
                Eliminar Cuenta
            </button>
        </form>

    </div>

</div>

@endsection
