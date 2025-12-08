<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{

    public function run(): void
    {
        Role::create([
            'name' => 'administrador',
            'description' => 'Administrador del sistema',
        ]);

        Role::create([
            'name' => 'vendedor',
            'description' => 'Gestión de ventas',
        ]);

        Role::create([
            'name' => 'almacen',
            'description' => 'Gestión de inventario',
        ]);
    }
}
