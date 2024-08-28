<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Service;
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
            'gender' => 'Male',
            'slug' => 'messi',
            'is_admin' => 1,
            'password' => Hash::make('password')
        ]);

        User::create([
            'name' => 'Ronaldo',
            'email' => 'CR7@suii.com',
            'is_admin' => false,
            'phone_number' => '0987654321',
            'gender' => 'Male',
            'slug' => 'ronaldo',
            'password' => Hash::make('password')
        ]);

        User::factory(3)->create();

        Service::create([
            'service_name' => 'Extra Bed',
            'service_description' => '120x80 sized bed',
            'service_price' => '500000',
            'slug' => 'extra-bed',
        ]);
        Service::create([
            'service_name' => 'Dinner',
            'service_description' => 'Regular Indonesian or Western Dinner',
            'service_price' => '100000',
            'slug' => 'dinner',
        ]);
        Service::create([
            'service_name' => 'Lunch',
            'service_description' => 'Regular Indonesian or Western Lunch',
            'service_price' => '75000',
            'slug' => 'lunch',
        ]);
    }
}
