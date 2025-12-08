{{-- Sidebar component --}}
<aside class="w-72 bg-gray-50 border-r border-gray-200 min-h-screen flex flex-col">
  <div class="px-6 py-6 flex items-center gap-3">
    {{-- Logo square with A B C colored letters --}}
    <div class="w-12 h-12 bg-white rounded-md flex items-center justify-center shadow">
      <div class="text-sm font-bold">
        <span class="text-yellow-400">A</span><span class="text-red-500">B</span><span class="text-blue-500">C</span>
      </div>
    </div>
    <div>
      <div class="text-sm font-bold text-gray-800">STOCK MANAGER</div>
      <div class="text-xs text-gray-500">Control de Inventario</div>
    </div>
  </div>

  <nav class="mt-4 px-2 space-y-1 flex-1">
    <a href="{{ route('dashboard') }}" class="group flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100">
      {{-- dashboard icon --}}
      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"/></svg>
      <span>Dashboard</span>
    </a>

    {{-- Inventario (selected) --}}
<a href="{{ route('inventario.index') }}" class="group flex items-center gap-3 px-4 py-2 rounded-md bg-olive-600 text-white" style="background-color:#8A9A3C;">
  <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18"/></svg>
  <span>Inventario</span>
</a>


    <a href="#" class="group flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100">
      <svg class="w-5 h-5"><!-- movimientos icon --></svg>
      <span>Movimientos</span>
    </a>

    <a href="#" class="group flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100">
      <svg class="w-5 h-5"><!-- reportes icon --></svg>
      <span>Reportes</span>
    </a>

    <a href="#" class="group flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100">
      <svg class="w-5 h-5"><!-- usuarios icon --></svg>
      <span>Usuarios</span>
    </a>

    <a href="#" class="group flex items-center gap-3 px-4 py-2 rounded-md text-gray-700 hover:bg-gray-100">
      <svg class="w-5 h-5"><!-- proveedores icon --></svg>
      <span>Proveedores</span>
    </a>
  </nav>

  {{-- collapse indicator (visual only) --}}
  <div class="px-2 py-4">
    <button class="w-full text-left px-3 py-2 rounded-md text-gray-600 hover:bg-gray-100 flex items-center justify-between">
      <span class="text-sm">Contraer menú</span>
      <svg class="w-4 h-4 transform rotate-0"><path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
    </button>
  </div>
</aside>
