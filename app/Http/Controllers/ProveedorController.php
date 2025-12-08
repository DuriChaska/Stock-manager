<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Models\Movimiento;
use Illuminate\Support\Facades\DB;

class ProveedorController extends Controller
{
    public function index(Request $request)
    {
        $stats = [
            'total' => Proveedor::count(),
            'activos' => Proveedor::where('activo', 1)->count(),
            'compras' => Movimiento::where('tipo', 'entrada')
                        ->sum(DB::raw('cantidad * costo')),
        ];

        $stats['total_productos'] = \App\Models\Producto::count();

        $stats['total_compras'] = Movimiento::where('tipo', 'entrada') ->sum(DB::raw('cantidad * costo'));

        $query = Proveedor::query();

        if ($request->filled('search')) {
            $q = $request->input('search');
            $query->where('nombre_empresa', 'like', "%{$q}%")
                ->orWhere('nombre_contacto', 'like', "%{$q}%")
                ->orWhere('email', 'like', "%{$q}%");
        }

        $proveedores = $query->orderBy('nombre_empresa')->paginate(10);

        return view('proveedores.index', compact('proveedores', 'stats'));
    }   

    public function create()
    {
        return view('proveedores.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email'          => 'nullable|email|max:255',
            'telefono'       => 'nullable|string|max:50',
            'direccion'      => 'nullable|string|max:255',
            'descripcion'    => 'nullable|string',
        ]);

        Proveedor::create($data);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor agregado correctamente.');
    }

    public function edit(Proveedor $proveedore)
    {
        return view('proveedores.edit', ['proveedor' => $proveedore]);
    }

    public function update(Request $request, Proveedor $proveedore)
    {
        $data = $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'nombre_contacto' => 'required|string|max:255',
            'email'          => 'nullable|email|max:255',
            'telefono'       => 'nullable|string|max:50',
            'direccion'      => 'nullable|string|max:255',
            'descripcion'    => 'nullable|string',
        ]);

        $proveedore->update($data);

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedore)
    {
        $proveedore->delete();

        return redirect()->route('proveedores.index')
                         ->with('success', 'Proveedor eliminado.');
    }

    public function show(Proveedor $proveedore)
    {
        return view('proveedores.show', ['proveedor' => $proveedore]);
    }
    
}
