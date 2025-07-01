<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('22222222'),
            'role' => 'admin'
        ]);
        \App\Models\User::create([
            'name' => 'Customer User',
            'email' => 'customer@example.com',
            'password' => bcrypt('11111111'),
            'role' => 'customer'
        ]);

        \App\Models\Product::create(['nama' => 'Kopi Hitam', 'harga' => 15000, 'deskripsi' => 'Kopi Arabika']);
        \App\Models\Product::create(['nama' => 'Kopi Susu', 'harga' => 18000, 'deskripsi' => 'Kopi dengan susu asli']);
    }
}