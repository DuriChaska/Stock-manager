<?php

namespace App\Http\Controllers;

use App\Models\Producto;

use App\Models\Proveedor;
use App\Models\User;
use Illuminate\Http\Request;
use App\Notifications\StockBajoNotification;
use App\Models\Marca;
use Illuminate\Support\Facades\Storage;


class InventarioController extends Controller
{

    
    public function index()
    {
        $productos = Producto::with('proveedor')->get();
        return view('inventario.index', compact('productos'));
    }

    
    public function create()
    {
        $proveedores = Proveedor::all();
        $marcas = Marca::all(); 
        return view('inventario.create', compact('proveedores', 'marcas'));
    }

    // guardar nuevo producto
    public function store(Request $request)
    {
        // validaciones basicas
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'existencia'   => 'required|integer|min:0',
            'proveedor_id' => 'required|exists:proveedores,id',
            'marca_id'     => 'required|exists:marcas,id',
            'imagen'       => 'nullable|image|max:2048'
        ]);

        // obtener todos los datos del request
        $data = $request->all();

        // guardar imagen si el usuario subio una
        if ($request->hasFile('imagen')) {
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        // crear producto
        $producto = Producto::create($data);

        // enviar notificacion si el producto queda con stock bajo
        if ($producto->existencia < 10) {
            foreach (User::where('role_id', 1)->get() as $admin) {
                $admin->notify(new StockBajoNotification($producto));
            }
        }

        return redirect()->route('inventario.index')
            ->with('success', 'Producto registrado correctamente.');
    }

    
    public function edit($id)
    {
        $producto = Producto::findOrFail($id);
        $marcas = Marca::all();
        $proveedores = Proveedor::all();

        return view('inventario.edit', compact('producto', 'marcas', 'proveedores'));
    }

    // actualizar producto
    public function update(Request $request, $id)
    {
        // validar datos
        $request->validate([
            'nombre'       => 'required|string|max:255',
            'precio'       => 'required|numeric|min:0',
            'existencia'   => 'required|integer|min:0',
            'marca_id'     => 'required|exists:marcas,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'imagen'       => 'nullable|image|max:2048'
        ]);

        // buscar producto a actualizar
        $producto = Producto::findOrFail($id);

        // obtener todos los datos
        $data = $request->all();

        // subir y guardar imagen
        if ($request->hasFile('imagen')) {

            // si ya tenia imagen, la elimino 
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }

            // guardar nueva imagen
            $data['imagen'] = $request->file('imagen')->store('productos', 'public');
        }

        // si no esta usando talla, eliminar valor
        if (!$request->has('talla') || $request->talla == null) {
            $data['talla'] = null;
        }

        // actualizar producto con los datos nuevos
        $producto->update($data);

        return redirect()->route('inventario.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

  
    public function destroy($id)
    {
        $producto = Producto::findOrFail($id);

       
        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }

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




