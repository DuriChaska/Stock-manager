<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; 

class UserController extends Controller
{
    
    public function index()
    {
        
        $users = User::with('role')->get(); 
      
        return view('users.index', compact('users'));
    }

    
    public function create()
    {
        
        $roles = Role::all(); 
 
        return view('users.create', compact('roles')); 
    }

   
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id', 
            'telefono' => 'nullable|string|max:20', 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), 
            'role_id' => $request->role_id, 
            'telefono' => $request->telefono,
        ]);

       
        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito.');
    }

    
    public function edit(User $usuario)
    {
        
        $roles = Role::all();
        $user = $usuario; 
       
        return view('users.edit', compact('user', 'roles'));
    }

   
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id, 
            'password' => 'nullable|string|min:8|confirmed', 
            'role_id' => 'required|exists:roles,id',
            'telefono' => 'nullable|string|max:20',
        ]);

        $data = $request->only(['name', 'email', 'role_id', 'telefono']);

        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

     
        return redirect()->route('usuarios.index')->with('success', 'Usuario actualizado con éxito.');
    }

   
    public function destroy(User $usuario)
    {
        $usuario->delete();
       
        return redirect()->route('usuarios.index')->with('success', 'Usuario eliminado con éxito.');
    }
}