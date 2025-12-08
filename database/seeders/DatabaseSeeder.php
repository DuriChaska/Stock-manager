<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    
    public function run(): void
    {
        $this->call(RoleSeeder::class);

        // si quieres un user de prueba:
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'role_id' => 1, // administrador
    ]);
    }
}   