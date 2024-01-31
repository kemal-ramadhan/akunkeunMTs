<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Versi;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Guru::create([
            'nuptk' => '3204320712000008',
            'nama' => 'Kemal Ramadhan',
            'jabatan' => 'Bagian Keuangan',
            'tanggal_lahir' => now(),
            'tempat_lahir' => 'Bandung',
            'email' => 'km.kemal03@gmail.com',
            'no_telepon' => '628986004677',
            'password' => bcrypt('123456'),
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Versi::create([
            'nama_versi' => 'Tahun Anggaran 2022/2023',
            'status' => 'Tidak Aktif',
        ]);

        Versi::create([
            'nama_versi' => 'Tahun Anggaran 2023/2024',
            'status' => 'Aktif',
        ]);
    }

}
