<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create 10 random users using a factory
        \App\Models\User::factory(10)->create();

        // Create a demo user with predefined credentials
        User::updateOrCreate(
            [
                'email' => 'admin@example.com',
            ],
            [
                'name' => 'Demo user',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin@example.com'), // Hash the password
                'role' => 'admin'
            ]
        );

        // Call other seeders
        $this->call(CategorySeeder::class);
        $this->call(ProductSeeder::class);
    }
}
