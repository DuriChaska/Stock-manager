@extends('layouts.app')

@section('content')
<div class="p-6">

    {{-- Título --}}
    <h1 class="mb-1 text-4xl font-bold">Gestión de Usuarios</h1>
    <p class="mb-10 text-gray-600">Administra los usuarios del sistema</p>

    {{-- CONTENEDOR PRINCIPAL --}}
    <div class="max-w-4xl p-10 mx-auto bg-white shadow-xl rounded-3xl">

        {{-- Subtítulo --}}
        <h2 class="mb-6 text-3xl font-bold">Registro de Usuarios</h2>

        {{-- FORMULARIO --}}
        <form action="{{ route('usuarios.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                {{-- Nombre Completo --}}
                <div>
                    <label class="font-semibold">Nombre Completo *</label>
                    <input type="text" name="name" required
                           class="w-full px-5 py-3 mt-2 border shadow outline-none rounded-2xl focus:ring-green-300 focus:ring"
                           placeholder="Nombre del usuario">
                </div>

                {{-- Email --}}
                <div>
                    <label class="font-semibold">Email *</label>
                    <input type="email" name="email" required
                           class="w-full px-5 py-3 mt-2 border shadow outline-none rounded-2xl focus:ring-green-300 focus:ring"
                           placeholder="email@ejemplo.com">
                </div>

                {{-- Contraseña --}}
                <div>
                    <label class="font-semibold">Contraseña *</label>
                    <input type="password" name="password" required
                           class="w-full px-5 py-3 mt-2 border shadow outline-none rounded-2xl focus:ring-green-300 focus:ring"
                           placeholder="••••••••">
                </div>

                {{-- Confirmación --}}
                <div>
                    <label class="font-semibold">Confirmar Contraseña *</label>
                    <input type="password" name="password_confirmation" required
                           class="w-full px-5 py-3 mt-2 border shadow outline-none rounded-2xl focus:ring-green-300 focus:ring"
                           placeholder="••••••••">
                </div>

                {{-- Rol de acceso --}}
                <div>
                    <label class="font-semibold">Rol de Acceso *</label>
                    <select name="rol_id" required
                            class="w-full px-5 py-3 mt-2 bg-white border shadow outline-none rounded-2xl focus:ring-green-300 focus:ring">
                        <option value="">Seleccione un rol...</option>

                        @foreach($roles as $rol)
                            <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Teléfono --}}
                <div>
                    <label class="font-semibold">Teléfono (Opcional)</label>
                    <input type="text" name="telefono"
                           class="w-full px-5 py-3 mt-2 border shadow outline-none rounded-2xl focus:ring-green-300 focus:ring"
                           placeholder="+52 449 123 4567">
                </div>

            </div>

            {{-- BOTONES --}}
            <div class="flex justify-between mt-10">

                {{-- Limpiar --}}
                <button type="reset"
                        class="px-6 py-3 text-gray-700 transition border border-gray-400 rounded-full hover:bg-gray-200">
                    Limpiar
                </button>

                <div class="flex gap-4">

                    {{-- Cancelar --}}
                    <a href="{{ route('usuarios.index') }}"
                       class="px-6 py-3 text-gray-700 transition border border-gray-400 rounded-full hover:bg-gray-200">
                        Cancelar
                    </a>

                    <button type="submit" 
                        class="flex items-center gap-2 px-8 py-2 text-black bg-[#97BB5C] rounded-full hover:bg-[#749646]">
                        <img src="{{ asset('images/savedisk_121993.png') }}" class="w-5 h-5" alt="Guardar">
                        Guardar Usuario
                    </button>

                </div>
            </div>

        </form>

    </div>

</div>
@endsection
