<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name' => 'Messi',
            'email' => 'Messi@goat.com',
            'is_admin' => false,
            'phone_number' => '1234567890',
            'gender' => 'male',
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Ronaldo',
            'email' => 'CR7@suii.com',
            'is_admin' => false,
            'phone_number' => '0987654321',
            'gender' => 'male',
            'password' => Hash::make('password')
        ]);

        User::factory(3)->create();
    }
}
