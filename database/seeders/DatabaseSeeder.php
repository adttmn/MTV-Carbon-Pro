<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Kategori;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    

        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp'  => '081234567892',
            'password' => bcrypt('admin'),
        ]);
        
        #Data Kategori
        Kategori::create([
            'nama_kategori' => 'Body Halus',
        ]);
        Kategori::create([
            'nama_kategori' => 'Body Kasar',
        ]);
        Kategori::create([
            'nama_kategori' => 'Part Lainnya',
        ]);
        
    }
}
