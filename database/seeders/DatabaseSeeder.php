<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::updateOrCreate(
            ['email' => 'admin@museum.go.id'],
            [
                'name' => 'Admin Museum',
                'password' => Hash::make('password')
            ]
        );

        // Seed questions
        $this->call(QuestionSeeder::class);
        $this->call(ReflectionSeeder::class);
    }
}
