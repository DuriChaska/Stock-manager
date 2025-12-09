@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Agregar Usuario</h1>

    <a href="{{ route('usuarios.index') }}"
       class="px-4 py-2 transition bg-gray-300 rounded-full hover:bg-gray-400">
        ← Regresar
    </a>
</div>

<div class="p-6 bg-white shadow-xl rounded-2xl">

    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-6">

            <!-- nombre -->
            <div>
                <label class="font-semibold">Nombre *</label>
                <input type="text" name="name"
                    value="{{ old('name') }}"
                    class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm 
                           @error('name') border-red-500 @enderror
                           focus:ring-green-400 focus:border-green-500">
                @error('name')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- email -->
            <div>
                <label class="font-semibold">Correo *</label>
                <input type="email" name="email"
                    value="{{ old('email') }}"
                    class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm
                           @error('email') border-red-500 @enderror
                           focus:ring-green-400 focus:border-green-500">
                @error('email')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- rol -->
            <div>
                <label class="font-semibold">Rol *</label>
                <select name="role_id"
                    class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm
                           @error('role_id') border-red-500 @enderror
                           focus:ring-green-400 focus:border-green-500">

                    <option value="" disabled selected>Selecciona un rol</option>

                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                    @endforeach

                </select>
                @error('role_id')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- contraseña -->
            <div>
                <label class="font-semibold">Contraseña *</label>
                <input type="password" name="password"
                    class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm
                           @error('password') border-red-500 @enderror
                           focus:ring-green-400 focus:border-green-500">
                @error('password')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <div class="flex justify-end gap-4 mt-6">
            <a href="{{ route('usuarios.index') }}"
               class="px-4 py-2 border rounded-xl hover:bg-gray-100">
                Cancelar
            </a>

            <button class="px-5 py-2 text-white bg-green-600 shadow rounded-xl hover:bg-green-700">
                Guardar usuario
            </button>
        </div>

    </form>
</div>

@endsection
