<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            [
                'name'              => "Super Administrador",
                'email'             => "superadmin@multinivel.test",
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token'    => Str::random(10),
                'phone'             => '+573002220022',
                'payment_data'      => '+573002220022',
                'status'            => 1,
                'role_id'           => 1,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);

        User::insert([
            [
                'name'              => "Administrador",
                'email'             => "admin@multinivel.test",
                'email_verified_at' => now(),
                'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                'remember_token'    => Str::random(10),
                'phone'             => '+573002220022',
                'payment_data'      => '+573002220022',
                'status'            => 1,
                'role_id'           => 2,
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);

        DB::table('component_permission_role')->insert([
            ['component_id' => 1, 'permission_id' => 1, 'role_id' => 1,],
            ['component_id' => 10, 'permission_id' => 1, 'role_id' => 1,],
            ['component_id' => 10, 'permission_id' => 2, 'role_id' => 1,],
            ['component_id' => 10, 'permission_id' => 3, 'role_id' => 1,],
            ['component_id' => 10, 'permission_id' => 4, 'role_id' => 1,],
            ['component_id' => 10, 'permission_id' => 5, 'role_id' => 1,],
            ['component_id' => 9, 'permission_id' => 1, 'role_id' => 1,],
        ]);

    }
}
