<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::insert([
            ['name' => 'Acceder', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Crear', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Consultar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Editar', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Cambiar estado', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
