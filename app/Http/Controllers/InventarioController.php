<?php

namespace App\Http\Controllers;

use App\Models\Producto;

use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\StockBajoNotification;
use App\Models\Marca;


class InventarioController extends Controller
{
    // Mostrar inventario
    public function index()
    {
        $productos = Producto::with('proveedor')->get();
        return view('inventario.index', compact('productos'));
    }

    // Formulario crear
   public function create()
    {
        $proveedores = Proveedor::all();
        $marcas = Marca::all(); // YA EXISTE

        return view('inventario.create', compact('proveedores', 'marcas'));
    }




    // Guardar producto
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'existencia'   => 'required|integer|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
            'imagen'       => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        // Guardar imagen si existe
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        $producto = Producto::create($data);

        // Notificar por stock bajo
        if ($producto->existencia < 10) {
            foreach (User::where('role_id', 1)->get() as $admin) {
                $admin->notify(new StockBajoNotification($producto));
            }
        }

        return redirect()->route('inventario.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    // Editar
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $marcas = Marca::all();
        $proveedores = Proveedor::all();

        return view('inventario.edit', compact('producto', 'marcas', 'proveedores'));
    }

    // Actualizar
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'existencia'   => 'required|integer|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
        ]);

        $producto = Producto::findOrFail($id);
        $producto->update($request->all());

        return redirect()->route('inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    // Eliminar
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        return redirect()->route('inventario.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    public function show($id)
    {
        $producto = Producto::with(['marca', 'proveedor'])->findOrFail($id);

        return view('inventario.show', compact('producto'));
    }
}




