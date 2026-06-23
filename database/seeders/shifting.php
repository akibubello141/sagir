<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class shifting extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
         shifting::factory()->create([
            'name' => 'Mornig',
        ]);

        shifting::factory()->create([
            'name' => 'Afternoon',
        ]);
    }
}
