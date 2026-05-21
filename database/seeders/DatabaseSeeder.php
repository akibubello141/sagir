<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'cashier',
            'email' => 'cashier@sagirltd.com',
            'password' => bcrypt('password'),
            'role' => 'cashier',
        ]);
         User::factory()->create([
            'name' => 'supervisor',
            'email' => 'supervisor@sagirltd.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor',
        ]);
         User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@sagirltd.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);
    }
}
