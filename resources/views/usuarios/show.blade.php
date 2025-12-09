@extends('layouts.app')

@section('content')
<div class="max-w-3xl p-6 mx-auto bg-white shadow-lg rounded-2xl">

    <div class="flex items-center gap-4 mb-6">
        <!-- avatar -->
        <div class="flex items-center justify-center w-16 h-16 text-2xl font-bold text-white rounded-full
                    bg-gradient-to-br from-[#97BB5C] to-[#749646]">
            {{ strtoupper(substr($user->name, 0, 1)) }}
        </div>

        <div>
            <h2 class="text-2xl font-semibold text-gray-800">{{ $user->name }}</h2>
            <p class="text-gray-500">{{ $user->email }}</p>
        </div>
    </div>

    <div class="space-y-4">

        <div class="flex justify-between">
            <span class="font-semibold">Rol:</span>
            <span class="px-3 py-1 text-sm text-white bg-green-600 rounded-full">
                {{ $user->role->name }}
            </span>
        </div>

        <div class="flex justify-between">
            <span class="font-semibold">Estado:</span>
            <span class="px-3 py-1 text-sm rounded-full 
                {{ $user->active ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                {{ $user->active ? 'Activo' : 'Inactivo' }}
            </span>
        </div>

        <div class="flex justify-between">
            <span class="font-semibold">Último acceso:</span>
            <span>
                {{ $user->last_login_at ? $user->last_login_at->diffForHumans() : 'Nunca ha iniciado sesión' }}
            </span>
        </div>

    </div>

    <div class="flex justify-end mt-8">
        <a href="{{ route('usuarios.index') }}"
            class="px-5 py-2 bg-[#749646] text-white rounded-lg hover:bg-[#5d7a37] transition">
            Volver
        </a>
    </div>

</div>
@endsection
