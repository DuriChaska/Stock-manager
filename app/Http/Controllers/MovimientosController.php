<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class MovimientosController extends Controller
{
   public function index()
    {
        $movimientos = Movimiento::with(['usuario', 'producto'])->orderBy('created_at', 'desc')->get();
        return view('movimientos.index', compact('movimientos'));
    }


    public function entrada()
    {
        $productos = \App\Models\Producto::with('marca')->orderBy('nombre')->get();
        $proveedores = \App\Models\Proveedor::orderBy('nombre_empresa')->get();
        return view('movimientos.entrada', compact('productos', 'proveedores'));
    }


    public function salida()
    {
        $productos = \App\Models\Producto::with('marca')->orderBy('nombre')->get();
        $proveedores = \App\Models\Proveedor::orderBy('nombre_empresa')->get();
        return view('movimientos.salida', compact('productos', 'proveedores'));
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'producto_id'  => 'required|exists:productos,id',
            'proveedor_id' => 'required|exists:proveedores,id',
            'tipo'         => 'required|in:entrada,salida',
            'cantidad'     => 'required|integer|min:1',
            'costo'        => 'nullable|numeric|min:0',
            'marca'        => 'nullable|string|max:255',
            'fecha'        => 'required|date',
        ]);

    $producto = \App\Models\Producto::find($data['producto_id']);

        if ($data['tipo'] === 'salida') {
            if ($producto->existencia < $data['cantidad']) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.'])->withInput();
        }
        // Restar existencia
        $producto->existencia -= $data['cantidad'];
        } else {
        // Sumar existencia
        $producto->existencia += $data['cantidad'];
    }

        $producto->save();

    // Guardar movimiento (tu modelo Movimiento debe tener $fillable correcto)
        \App\Models\Movimiento::create([
            'usuario_id'   => auth()->id() ?? 1, // si usas auth real, usa auth()->id()
            'producto_id'  => $data['producto_id'],
            'proveedor_id' => $data['proveedor_id'],
            'tipo'         => $data['tipo'],
            'cantidad'     => $data['cantidad'],
            'costo'        => $data['costo'] ?? null,
            'marca'        => $data['marca'] ?? null,
            'fecha'        => $data['fecha'],
        ]);

        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado correctamente.');
    }

    public function create()
    {
        $productos = \App\Models\Producto::orderBy('nombre')->get();
        $usuarios = \App\Models\Usuario::orderBy('nombre')->get();
        return view('movimientos.entrada', compact('productos', 'usuarios'));
    }


}
