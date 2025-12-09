<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class ProductoController extends Controller
{
   
    public function index()
    {
  
        return view('inventario.index'); 
    }

    public function create()
    {
    
        return view('inventario.create');
    }

    
    public function store(Request $request)
    {

        return redirect()->route('inventario.index')->with('status', 'Producto creado (simulado) exitosamente.');
    }
}
