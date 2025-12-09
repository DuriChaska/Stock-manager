<header class="bg-white border-b border-gray-200">
  <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
   
      <div class="flex-1">
       
        <div class="text-xs text-gray-500">
          @hasSection('title-small')
            @yield('title-small')
          @else
           
          @endif
        </div>
      </div>

 
      <div class="flex justify-center flex-1">
        <div class="w-full max-w-xl">
          <form action="#" method="GET" class="relative">
            <input name="q" placeholder="Buscar" class="w-full px-4 py-2 pl-4 pr-10 border border-gray-200 rounded-full shadow-sm focus:outline-none focus:ring-1 focus:ring-green-200" />
            <button type="submit" class="absolute p-2 -translate-y-1/2 rounded-full right-1 top-1/2">
              <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M17 11a6 6 0 11-12 0 6 6 0 0112 0z"/></svg>
            </button>
          </form>
        </div>
      </div>

  
      <div class="flex items-center justify-end flex-1 gap-4">
        <button class="p-2 rounded-md hover:bg-gray-100" title="Notificaciones">
          <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
        </button>

        <div class="relative">
          <x-dropdown align="right" width="48">
            <x-slot name="trigger">
              <button class="flex items-center gap-2 px-3 py-2 rounded-md hover:bg-gray-100">
                <div class="flex items-center justify-center w-8 h-8 text-sm text-gray-700 bg-gray-200 rounded-full">{{ strtoupper(substr(Auth::user()->name,0,1)) }}</div>
              </button>
            </x-slot>

            <x-slot name="content">
              <x-dropdown-link :href="route('profile.edit')">Perfil</x-dropdown-link>
              <form method="POST" action="{{ route('logout') }}">@csrf
                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">Cerrar sesión</x-dropdown-link>
              </form>
            </x-slot>
          </x-dropdown>
        </div>
      </div>
    </div>
  </div>
</header>
