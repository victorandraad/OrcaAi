<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Material;
use App\Models\Formula;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $email = 'test@example.com';
        
        // Check if the email already exists
        if (!User::where('email', $email)->exists()) {
            User::create([
                'name' => 'Test User',
                'email' => $email,
                'password' => bcrypt('your_password'),
                // ... other fields ...
            ]);
        }

        $units = ['metro', 'centímetro', 'polegada', 'unidade'];

        for ($i = 1; $i <= 50; $i++) {
            Material::create([
                'name' => 'Material ' . $i,
                'price' => rand(100, 1000) / 100,
                'unit' => $units[array_rand($units)],
            ]);
        }

        $operators = ['+', '-', '*', '/', '%'];

        for ($i = 1; $i <= 50; $i++) {
            $formula = Formula::create([
                'name' => 'Fórmula ' . $i,
                'formula' => '{material1} ' . $operators[array_rand($operators)] . ' {material2}',
            ]);

            $materials = Material::inRandomOrder()->limit(2)->get();
            $formula->materials()->attach($materials);
        }
    }
}
