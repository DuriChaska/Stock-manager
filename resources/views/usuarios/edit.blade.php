<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Editar Usuario
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-bold">Editar Usuario</h1>

                <a href="{{ route('usuarios.index') }}"
                   class="px-4 py-2 transition bg-gray-300 rounded-full hover:bg-gray-400">
                    ← Regresar
                </a>
            </div>

            <div class="p-6 bg-white shadow-xl rounded-2xl">
                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                        {{-- Nombre --}}
                        <div>
                            <label class="font-semibold">Nombre *</label>
                            <input type="text" name="name"
                                   value="{{ old('name', $usuario->name) }}"
                                   class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm
                                          @error('name') border-red-500 @enderror
                                          focus:ring-green-400 focus:border-green-500">
                            @error('name')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Correo --}}
                        <div>
                            <label class="font-semibold">Correo *</label>
                            <input type="email" name="email"
                                   value="{{ old('email', $usuario->email) }}"
                                   class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm
                                          @error('email') border-red-500 @enderror
                                          focus:ring-green-400 focus:border-green-500">
                            @error('email')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Rol --}}
                        <div>
                            <label class="font-semibold">Rol *</label>
                            <select name="role_id"
                                class="w-full mt-1 px-4 py-2 border rounded-xl shadow-sm
                                       @error('role_id') border-red-500 @enderror
                                       focus:ring-green-400 focus:border-green-500">

                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ $usuario->role_id == $role->id ? 'selected' : '' }}>
                                        {{ ucfirst($role->name) }}
                                    </option>
                                @endforeach

                            </select>
                            @error('role_id')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Nueva contraseña --}}
                        <div>
                            <label class="font-semibold">Nueva contraseña (opcional)</label>
                            <input type="password" name="password"
                                   class="w-full px-4 py-2 mt-1 border shadow-sm rounded-xl focus:ring-green-400 focus:border-green-500">
                            <small class="text-gray-500">Déjalo vacío si no deseas cambiarla.</small>
                        </div>

                    </div>

                    <div class="flex justify-end gap-4 mt-6">
                        <a href="{{ route('usuarios.index') }}"
                           class="px-4 py-2 bg-gray-300 rounded-xl hover:bg-gray-400">
                            Cancelar
                        </a>

                        <button type="submit"
                                class="px-6 py-2 font-semibold text-white transition bg-green-600 rounded-xl hover:bg-green-700">
                            Guardar cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</x-app-layout>
