{{-- NAVIGATION BLADE --}}

<div class="relative flex items-center gap-6">

    {{-- 🔔 CAMPANA DE NOTIFICACIONES --}}
    <div class="relative">
        <button onclick="toggleNotifications()" class="relative">
            <img src="{{ asset('images/bell_ring_outline_icon_139893.png') }}" class="w-6">

            @if(Auth::user()->unreadNotifications->count() > 0)
                <span class="absolute flex items-center justify-center w-4 h-4 text-xs text-white bg-red-600 rounded-full -top-1 -right-1">
                    {{ Auth::user()->unreadNotifications->count() }}
                </span>
            @endif
        </button>

        {{-- PANEL DE NOTIFICACIONES --}}
        <div id="notifPanel"
            class="absolute right-0 z-50 hidden p-4 mt-3 bg-white shadow-xl w-80 rounded-xl">

            <h3 class="mb-3 font-bold text-gray-800">Notificaciones</h3>

            @forelse(Auth::user()->unreadNotifications as $notif)
                <div class="p-3 mb-2 bg-gray-100 rounded-lg">
                    {{ $notif->data['message'] }}
                </div>
            @empty
                <p class="text-sm text-gray-500">No tienes notificaciones.</p>
            @endforelse

        </div>
    </div>


    {{-- 🔽 DROPDOWN DEL USUARIO --}}
    <x-dropdown align="right" width="48">

        <x-slot name="trigger">
            <button class="flex items-center gap-3">
                
                {{-- Avatar --}}
                <div class="flex items-center justify-center w-10 h-10 font-bold text-white
                    rounded-full bg-gradient-to-br from-[#97BB5C] to-[#749646] shadow">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>

                {{-- Nombre --}}
                <span class="text-[#749646] font-semibold">
                    {{ Auth::user()->name }}
                </span>

                <svg class="w-4 h-4 text-[#749646]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                    <path fill-rule="evenodd"
                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                          clip-rule="evenodd"/>
                </svg>

            </button>
        </x-slot>


        <x-slot name="content">
            <x-dropdown-link :href="route('profile.edit')">
                Perfil
            </x-dropdown-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault(); this.closest('form').submit();">
                    Cerrar sesión
                </x-dropdown-link>
            </form>
        </x-slot>

    </x-dropdown>
</div>


{{-- SCRIPT NOTIFICACIONES --}}
<script>
function toggleNotifications() {
    const panel = document.getElementById('notifPanel');
    panel.classList.toggle('hidden');

    // Marcar como leídas
    fetch("/notificaciones/leer");
}
</script>
