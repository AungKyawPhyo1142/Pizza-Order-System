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
     *
     * @return void
     */
    public function run()
    {

        // here, we won't create Seeder specifically,
        // 'cause we only want one admin(role) data inside the User Table
        // whenever we migrate or fresh the table

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'phone' => '09769477990',
            'gender' => 'male',
            'address' => 'Mandalay',
            'role' => 'admin',
            'password' => Hash::make('1234567890') // hash the password
        ]);

    }
}
