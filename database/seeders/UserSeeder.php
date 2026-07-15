<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         User::updateOrCreate(
            ['email' => 'manager@sagirenterprises.com.ng'],
            [
                'name' => 'Manager',
                'email' => 'manager@sagirenterprises.com.ng',
                'password' => Hash::make('password'),
                'role' => 'manager',
            ]
        );

        User::updateOrCreate(
            ['email' => 'cashier@sagirenterprises.com.ng'],
            [
                'name' => 'Cashier',
                'email' => 'cashier@sagirenterprises.com.ng',
                'password' => Hash::make('password'),
                'role' => 'cashier',
            ]
        );
    }
}
