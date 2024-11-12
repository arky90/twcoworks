<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'role' => 'admin', 
            'email_verified_at' => '01/01/2024',
            'password' => '1234'
        ]); 

        // Status
        $this->call(StatusSeeder::class);
    }
}
