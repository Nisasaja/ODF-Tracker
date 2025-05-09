<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; 
use App\Models\Laporan;

class LaporanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // Ambil pengguna pertama (atau buat pengguna baru jika belum ada)

        if (!$user) {
            $user = User::create([
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }

        // Buat laporan dummy
        Laporan::create([
            'judul_laporan' => 'Contoh Laporan',
            'isi_laporan' => 'Ini adalah isi laporan.',
            'tgl_laporan' => now(),
            'status' => 'selesai',
            'user_id' => $user->id,
        ]);
    }
}
