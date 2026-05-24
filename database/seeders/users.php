<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
          Users::factory()->create([
            'name' => 'cashier',
            'email' => 'cashier@sagirltd.com',
            'password' => bcrypt('password'),
            'role' => 'cashier',
        ]);
         Users::factory()->create([
            'name' => 'supervisor',
            'email' => 'supervisor@sagirltd.com',
            'password' => bcrypt('password'),
            'role' => 'supervisor',
        ]);
         Users::factory()->create([
            'name' => 'manager',
            'email' => 'manager@sagirltd.com',
            'password' => bcrypt('password'),
            'role' => 'manager',
        ]);
    }
}
