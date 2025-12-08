<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Marca;
use Illuminate\Http\Request;

class InventarioController extends Controller
{
    // Mostrar listado del inventario
    public function index()
    {
        $productos = Producto::with('marca')->get();
        return view('inventario.index', compact('productos'));
    }

    // Mostrar formulario crear
    public function create()
    {
        $marcas = Marca::all();
        return view('inventario.create', compact('marcas'));
    }

    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'marca_id' => 'required',
            'talla' => 'nullable',
            'existencia' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0'
        ]);

        Producto::create($request->all());

        return redirect()->route('inventario.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    // Mostrar formulario de edición
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $marcas = Marca::all();

        return view('inventario.edit', compact('producto', 'marcas'));
    }

    // Actualizar producto
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'marca_id' => 'required',
            'talla' => 'nullable',
            'existencia' => 'required|integer|min:0',
            'precio' => 'required|numeric|min:0',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar producto
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('inventario.index')
            ->with('success', 'Producto eliminado correctamente.');
    }
}



