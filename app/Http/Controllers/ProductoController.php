<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductoController extends Controller
{
   
    public function index()
    {
  
        return view('productos.index'); 
    }

    public function create()
    {
    
        return view('productos.create');
    }

    
    public function store(Request $request)
    {

        return redirect()->route('productos.index')->with('status', 'Producto creado (simulado) exitosamente.');
    }
}
