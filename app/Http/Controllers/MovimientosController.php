<?php

namespace App\Http\Controllers;

use App\Models\Movimiento;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Marca;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MovimientosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $movimientos = Movimiento::with(['usuario', 'producto'])
            ->orderBy('created_at', 'desc')
            ->get();

        // estadisticas
        $stats = [
            'entradas' => Movimiento::where('tipo', 'entrada')->sum('cantidad'),
            'salidas' => Movimiento::where('tipo', 'salida')->sum('cantidad'),
            'balance' => Movimiento::where('tipo', 'entrada')->sum('cantidad')
                        - Movimiento::where('tipo', 'salida')->sum('cantidad'),
        ];

        $marcas = Marca::orderBy('nombre')->get();

        return view('movimientos.index', compact('movimientos', 'stats', 'marcas'));
    }


   
    public function entrada()
    {
        $productos = Producto::with('marca')->orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre_empresa')->get();

        return view('movimientos.entrada', compact('productos', 'proveedores'));
    }


    
    public function salida()
    {
        $productos = Producto::with('marca')->orderBy('nombre')->get();
        $proveedores = Proveedor::orderBy('nombre_empresa')->get();

        return view('movimientos.salida', compact('productos', 'proveedores'));
    }


    // guardar movimiento
    public function store(Request $request)
    {
        $data = $request->validate([
            'producto_id'  => 'required|exists:productos,id',
            'proveedor_id' => 'nullable|exists:proveedores,id',
            'tipo'         => 'required|in:entrada,salida',
            'cantidad'     => 'required|integer|min:1',
            'costo'        => 'nullable|numeric|min:0',
            
            'fecha'        => 'required|date',
        ]);

        $producto = Producto::find($data['producto_id']);

        // validacion de existencia
        if ($data['tipo'] === 'salida' && $producto->existencia < $data['cantidad']) {
            return back()->withErrors(['cantidad' => 'No hay suficiente stock disponible.'])->withInput();
        }

        // actualizar stock
        $producto->existencia += ($data['tipo'] === 'entrada' ? $data['cantidad'] : -$data['cantidad']);
        $producto->save();

        // guardar movimiento
        Movimiento::create([
            'usuario_id' => auth()->id(),
            'producto_id'  => $data['producto_id'],
            'proveedor_id' => $data['proveedor_id'] ?? null,
            'tipo'         => $data['tipo'],
            'cantidad'     => $data['cantidad'],
            'costo'        => $data['costo'] ?? null,

            'fecha'        => $data['fecha'],
        ]);

        



        return redirect()->route('movimientos.index')->with('success', 'Movimiento registrado correctamente.');
    }

    
}
