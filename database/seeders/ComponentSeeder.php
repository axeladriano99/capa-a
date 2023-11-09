<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Component;

class ComponentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $components = [
            ['name' => 'Panel'],
            ['name' => 'Administrar'],
            ['name' => 'Métodos de pago', 'parent_id' => 2],
            ['name' => 'Campañas', 'parent_id' => 2],
            ['name' => 'Usuarios', 'parent_id' => 2],
            ['name' => 'Mi cuenta'],
            ['name' => 'Gestionar referidos', 'parent_id' => 6],
            ['name' => 'Gestionar pagos', 'parent_id' => 6],
            ['name' => 'Seguridad',],
            ['name' => 'Roles', 'parent_id' => 9],
        ];
        foreach ($components as $component) {
            Component::create($component);
        }
        
    }
}
