<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
            ['name' => 'Colombia', 'prefix' => 'CO', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Canadá', 'prefix' => 'CA', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Estados Unidos', 'prefix' => 'US', 'created_at' => now(), 'updated_at' => now()],
        ]);
        
    }
}
