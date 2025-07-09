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
        // User::factory(10)->create();

        User::create([
            'nama' => 'Administrator',
            'email' => 'admin@gmail.com',
            'role' => '1',
            'status' => 1,
            'hp'  => '081234567892',
            'password' => bcrypt('superadmin'),
        ]);
        // User::create([
        //     'nama' => 'Praditya Rizky Permana',
        //     'email' => 'praditya@gmail.com',
        //     'role' => '0',
        //     'status' => 1,
        //     'hp'  => '087877794771',
        //     'password' => bcrypt('admin'),
        // ]);
        User::create([
            'nama' => 'Arief Hidayat',
            'email' => 'arief@gmail.com',
            'role' => '0',
            'status' => 1,
            'hp'  => '085756789367',
            'password' => bcrypt('P@55word'),
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
        // Kategori::create([
        //     'nama_kategori' => 'Mochi',
        // ]);
        // Kategori::create([
        //     'nama_kategori' => 'Wingko',
        // ]);
    }
}
