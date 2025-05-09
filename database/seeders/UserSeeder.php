<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

// class UserSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         // Admin
//         User::create([
//             'name' => 'Admin User',
//             'email' => 'admin@gmail.com',
//             'password' => Hash::make('mbkm2024'),
//             'role' => 'admin',
//         ]);

//         // Petugas Lapangan
//         User::create([
//             'name' => 'Petugas Lapangan',
//             'email' => 'petugas@gmail.com',
//             'password' => Hash::make('ODF2024'), 
//             'role' => 'petugas_lapangan',
//         ]);
//     }
// }

class UserSeeder extends Seeder
{
    public function run()
    {
        // Periksa apakah admin sudah ada
        if (!User::where('email', 'admin@gmail.com')->exists()) {
            User::create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('mbkm2024'),
                'role' => 'admin',
            ]);
        }

        // Periksa apakah petugas sudah ada
        if (!User::where('email', 'petugas@gmail.com')->exists()) {
            User::create([
                'name' => 'Petugas Lapangan',
                'email' => 'petugas@gmail.com',
                'password' => Hash::make('ODF2024'), 
                'role' => 'petugas_lapangan',
            ]);
        }
    }
}
