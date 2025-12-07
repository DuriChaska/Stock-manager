<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Producto; // Puedes descomentar esto cuando necesites el modelo

class ProductoController extends Controller
{
    /**
     * Muestra la tabla de gestión de inventario. (Ruta GET /inventario)
     */
    public function index()
    {
        // Esto carga tu vista con la tabla: resources/views/productos/index.blade.php
        return view('productos.index'); 
    }

    /**
     * Muestra el formulario para crear un nuevo producto. (Ruta GET /inventario/crear)
     */
    public function create()
    {
        // Esto carga tu vista con el formulario: resources/views/productos/create.blade.php
        return view('productos.create');
    }

    /**
     * Procesa y guarda un nuevo producto. (Ruta POST /inventario)
     */
    public function store(Request $request)
    {
        // Aquí iría la lógica para validar y guardar los datos en la base de datos.
        return redirect()->route('productos.index')->with('status', 'Producto creado (simulado) exitosamente.');
    }
}
