<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('Admin@123456'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'is_admin' => true,
            'is_active' => true,
            'username' => fake()->userName(),
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
