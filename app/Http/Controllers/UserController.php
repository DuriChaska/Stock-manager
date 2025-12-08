<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;


class UserController extends Controller
{

    public function index()
    {
        $users = User::with('role')->get();

        return view('usuarios.index', [
            'users'          => $users,
            'totalUsuarios'  => $users->count(),
            'totalAdmins'    => $users->where('role.name', 'administrador')->count(),
            'totalVendedores'=> $users->where('role.name', 'vendedor')->count(),
            'totalAlmacen'   => $users->where('role.name', 'almacen')->count(),
        ]);
    }

    public function create()
    {
        $roles = Role::all();
        return view('usuarios.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id'  => 'required|exists:roles,id',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }
}
