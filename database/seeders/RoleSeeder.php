<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::insert([
            ['name' => 'Super Administrador', 'description' => 'Rol para super administrador del sistema', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Administrador', 'description' => 'Rol para administrador del sistema', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Invitado', 'description' => 'Rol para invitados', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
