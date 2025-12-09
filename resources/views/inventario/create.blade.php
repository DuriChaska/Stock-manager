@extends('layouts.app')

@section('title', 'Agregar Producto')

@section('content')

<h1 class="mb-4 text-3xl font-bold">Gestión de Inventario</h1>
<p class="mb-8 text-gray-500">Añade nuevos productos a tu inventario</p>

<div class="p-8 bg-white shadow-xl rounded-xl">

    <h2 class="flex items-center gap-2 mb-6 text-2xl font-semibold">
        <i class="text-green-600 fa-solid fa-plus"></i>
        Agregar producto
    </h2>

    <form action="{{ route('inventario.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

            <!-- nombre -->
            <div>
                <label class="block mb-1 font-medium">Nombre del producto *</label>
                <input type="text" name="nombre"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                       required>
            </div>

            <!-- marca -->
            <div>
                <label class="font-medium">Marca *</label>
                
                <div class="flex gap-2">
                    <select id="marca_id" name="marca_id"
                        class="w-full px-4 py-2 text-black bg-white border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                        required>
                        <option value="">Seleccione Marca</option>

                        @foreach ($marcas as $marca)
                            <option value="{{ $marca->id }}">{{ $marca->nombre }}</option>
                        @endforeach
                    </select>

                    <!-- boton para agregar marca -->
                    <button type="button"
                        id="btnAbrirModalMarca"
                        class="px-4 text-xl font-bold text-white bg-green-600 rounded-full hover:bg-green-700">
                        +
                    </button>
                </div>
            </div>

            <!-- proveedor -->
            <div>
                <label class="font-medium">Proveedor *</label>
                <select name="proveedor_id"
                    class="w-full px-4 py-2 text-black bg-white border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                    required>
                    <option value="">Seleccione Proveedor</option>

                    @foreach ($proveedores as $proveedor)
                        <option value="{{ $proveedor->id }}">{{ $proveedor->nombre_empresa }}</option>
                    @endforeach
                </select>
            </div>

            <!-- precio -->
            <div>
                <label class="font-medium">Precio *</label>
                <input type="number" step="0.01" name="precio"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                       required>
            </div>

            <!-- stock -->
            <div>
                <label class="font-medium">Stock inicial *</label>
                <input type="number" name="existencia"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400"
                       required>
            </div>

            <!-- activar talla -->
            <div>
                <label class="font-medium">¿Usa talla?</label>

                <div class="flex items-center gap-2 mt-1">
                    <input type="checkbox" id="toggleTalla" onchange="mostrarTalla()"
                           class="w-5 h-5 text-green-600 cursor-pointer">
                    <span class="text-gray-600">Este producto maneja tallas</span>
                </div>
            </div>

            <!-- campo talla -->
            <div id="campoTalla" class="hidden">
                <label class="block mb-1 font-medium">Talla (opcional)</label>
                <input type="text" name="talla"
                       placeholder="Ej: M, 32, 500ml, 7"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400">
            </div>

            <!-- imagen -->
            <div class="col-span-2">
                <label class="font-medium">Imagen del producto</label>
                <input type="file" name="imagen"
                       class="w-full px-4 py-2 border shadow-inner rounded-xl focus:ring-2 focus:ring-green-400">
            </div>

        </div>

        {{-- botones --}}
        <div class="flex justify-between mt-10">

            <button type="reset"
                    class="px-6 py-3 text-gray-700 border rounded-full hover:bg-gray-200">
                Limpiar
            </button>

            <div class="flex gap-4">
                <a href="{{ route('inventario.index') }}"
                   class="px-6 py-3 text-gray-700 border rounded-full hover:bg-gray-200">
                    Cancelar
                </a>

                <button type="submit" 
                        class="flex items-center gap-2 px-8 py-2 text-black bg-[#97BB5C] rounded-full hover:bg-[#749646]">
                    <img src="{{ asset('images/savedisk_121993.png') }}" class="w-5">
                    Guardar Producto
                </button>
            </div>
        </div>

    </form>

</div>

@endsection

{{-- script mostrar talla --}}
<script>
function mostrarTalla() {
    const chk = document.getElementById('toggleTalla');
    const campo = document.getElementById('campoTalla');
    campo.classList.toggle('hidden', !chk.checked);
}
</script>

{{-- modal nueva marca --}}
<div id="modalNuevaMarca"
     class="fixed inset-0 z-50 items-center justify-center hidden bg-black/40">
    <div class="w-full max-w-md p-6 bg-white shadow-xl rounded-2xl">

        <h2 class="mb-4 text-xl font-semibold">Nueva marca</h2>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700">
                Nombre de la marca
            </label>
            <input type="text" id="nombre_marca"
                   class="w-full px-3 py-2 mt-1 border rounded-xl focus:ring-green-400 focus:border-green-500">
            <p id="error_marca" class="hidden mt-1 text-sm text-red-600"></p>
        </div>

        <div class="flex justify-end gap-3 mt-4">
            <button type="button" id="btnCancelarMarca"
                class="px-4 py-2 bg-gray-300 rounded-xl hover:bg-gray-400">
                Cancelar
            </button>
            <button type="button" id="btnGuardarMarca"
                class="px-4 py-2 font-semibold text-white bg-green-600 rounded-xl hover:bg-green-700">
                Guardar
            </button>
        </div>

    </div>
</div>

{{-- script ajax nueva marca --}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const btnAbrirModal = document.getElementById('btnAbrirModalMarca');
    const modal = document.getElementById('modalNuevaMarca');
    const btnCancelar = document.getElementById('btnCancelarMarca');
    const btnGuardar = document.getElementById('btnGuardarMarca');
    const inputNombre = document.getElementById('nombre_marca');
    const errorText = document.getElementById('error_marca');
    const selectMarca = document.getElementById('marca_id');

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    btnAbrirModal.addEventListener('click', () => {
        inputNombre.value = '';
        errorText.textContent = '';
        errorText.classList.add('hidden');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        inputNombre.focus();
    });

    btnCancelar.addEventListener('click', () => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    });

    btnGuardar.addEventListener('click', async () => {
        const nombre = inputNombre.value.trim();

        if (!nombre) {
            errorText.textContent = 'Escribe un nombre para la marca.';
            errorText.classList.remove('hidden');
            return;
        }

        try {
            const response = await fetch('/marcas/store-ajax', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: JSON.stringify({ nombre }),
            });

            const marca = await response.json();

            // crear opcion nueva y seleccionarla
            const option = document.createElement('option');
            option.value = marca.id;
            option.textContent = marca.nombre;
            option.selected = true;

            selectMarca.appendChild(option);

            modal.classList.add('hidden');
            modal.classList.remove('flex');

        } catch (err) {
            errorText.textContent = 'Ocurrió un error al guardar la marca.';
            errorText.classList.remove('hidden');
        }
    });

    // cerrar modal al hacer click fuera
    modal.addEventListener('click', (e) => {
        if (e.target === modal) {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }
    });
});
</script>
