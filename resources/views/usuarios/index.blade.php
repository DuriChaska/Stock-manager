@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')

<div class="flex items-center justify-between mb-6">
    <h1 class="text-3xl font-bold">Usuarios</h1>

    <a href="{{ route('usuarios.create') }}"
       class="px-5 py-2 text-white transition bg-green-600 rounded-full shadow hover:bg-green-700">
        + Agregar Usuario
    </a>
</div>

<div class="p-6 bg-white shadow-xl rounded-2xl">

    <table class="w-full">
        <thead>
            <tr class="font-semibold text-gray-600 border-b">
                <th class="flex items-center gap-2 py-3 text-left">
                    <i class="text-xl fa-regular fa-user"></i> Usuarios
                </th>
                <th class="py-3 text-left">Correo Electrónico</th>
                <th class="py-3 text-left">Rol</th>
                <th class="py-3 text-left">Actividad</th>
                <th class="py-3 text-center">Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $u)
            <tr class="border-b hover:bg-gray-50">
                
                <!-- Avatar + Nombre -->
                <td class="py-4">
                    <div class="flex items-center gap-4">

                        <div class="flex items-center justify-center w-10 h-10 font-bold text-white bg-green-600 rounded-full">
                            {{ strtoupper(substr($u->name, 0, 1)) }}
                        </div>

                        <div>
                            <p class="font-semibold text-gray-800">{{ $u->name }}</p>
                            <p class="text-sm text-gray-500">
                                Último acceso:
                                {{ $u->last_login_at ? $u->last_login_at->diffForHumans() : 'Nunca' }}
                            </p>
                        </div>

                    </div>
                </td>

                <!-- Email -->
                <td class="text-gray-700">{{ $u->email }}</td>

                <!-- Rol -->
                <td>
                    <span class="px-3 py-1 text-sm text-green-700 bg-green-100 rounded-full">
                        {{ $u->role->name ?? 'Sin rol' }}
                    </span>
                </td>

                <!-- Estado -->
                <td>
                    @if ($u->active)
                        <span class="px-3 py-1 text-sm text-green-800 bg-green-200 rounded-full">
                            ● Activo
                        </span>
                    @else
                        <span class="px-3 py-1 text-sm text-red-800 bg-red-200 rounded-full">
                            ● Inactivo
                        </span>
                    @endif
                </td>

                <!-- Acciones -->
                <td class="text-center">
                    <div class="flex justify-center gap-4 text-xl">

                        <!-- VER -->
                        <a href="{{ route('usuarios.show', $u->id) }}">
                            <img src="/images/eye_visible_hide_hidden_show_icon_145988.png" class="w-5 opacity-70 hover:opacity-100">
                        </a>

                        <!-- EDITAR -->
                        <a href="{{ route('usuarios.edit', $u->id) }}">
                            <img src="/images/creative_design_draw_illustration_pen_pencil_write_icon_123895.png" class="w-5 opacity-70 hover:opacity-100">
                        </a>

                        <!-- ELIMINAR -->
                        <form action="{{ route('usuarios.destroy', $u->id) }}" method="POST"
                            onsubmit="return confirm('¿Eliminar usuario?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">
                                <img src="/images/1485477104-basket_78591.png" class="w-5 opacity-70 hover:opacity-100">
                            </button>
                        </form>

                    </div>
                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

</div>







@endsection
