<?php

namespace Database\Seeders;

use App\Models\Guru;

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
            'id_jabatan' => '1',
            'nama' => 'Kemal Ramadhan',
            'tanggal_lahir' => now(),
            'tempat_lahir' => 'Bandung',
            'email' => 'km.kemal03@gmail.com',
            'no_telepon' => '628986004677',
            'username' => 'kemal123',
            'password' => bcrypt('123456'),
            'status' => 'aktif',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

}
