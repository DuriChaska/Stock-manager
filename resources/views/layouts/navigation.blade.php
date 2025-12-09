<nav x-data="{ open: false }" class="bg-white">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <!-- Logo -->
                <div class="flex items-center shrink-0">
                    <a href="{{ route('dashboard') }}">
                        <!-- (Tu logo si lo necesitas) -->
                    </a>
                </div>

            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">

                <!-- 🟢 ESTE ES EL DROPDOWN CORRECTO -->
                <x-dropdown align="right" width="48">

                    <!-- Trigger (avatar + nombre) -->
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 p-0 m-0 bg-transparent border-none shadow-none focus:outline-none hover:bg-transparent">

                            <!-- Avatar -->
                            <div class="flex items-center justify-center w-10 h-10 font-bold text-white
                                        rounded-full shadow bg-gradient-to-br from-[#97BB5C] to-[#749646] hover:scale-105 transition">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <!-- Nombre -->
                            <span class="text-[#749646] font-semibold">
                                {{ Auth::user()->name }}
                            </span>

                            <!-- Flecha -->
                            <svg class="w-4 h-4 text-[#749646]" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>

                        </button>
                    </x-slot>

                    <!-- Dropdown Content -->
                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Perfil
                        </x-dropdown-link>

                        <!-- Logout -->
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


            <!-- Hamburger Menu -->
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Dashboard link -->
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
        </div>

        <!-- User info + logout -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="text-base font-medium text-gray-800">{{ Auth::user()->name }}</div>
                <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Perfil
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    s
                    <x-responsive-nav-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Cerrar sesión
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
