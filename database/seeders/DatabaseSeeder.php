<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\Versi;
use App\Models\Pengeluaran;
use App\Models\HubPengeluaran;
use App\Models\Kakeibo;

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
        
        Pengeluaran::create([
            'id_versi' => '2',
            'nama_pengeluaran' => 'Pengeluaran Umum Tahun Anggaran 2023/2024',
            'keterangan' => 'Pengeluaran Umum Tahun Anggaran 2023/2024, pengajuan selama tahun anggaran 2023/2024',
            'status' => 'Aktif',
        ]);

        HubPengeluaran::create([
            'id_pengeluaran' => '1',
            'id_guru' => '1',
        ]);
        
        Kakeibo::create([
            'jenis' => 'Survival',
            'keterangan' => 'pengeluaran rutin yang tetap setiap bulannya, seperti sewa atau cicilan rumah, tagihan utilitas (listrik, air, gas), angsuran pinjaman, premi asuransi, dan langganan layanan',
        ]);
        
        Kakeibo::create([
            'jenis' => 'Optional',
            'keterangan' => 'Pengeluaran ini bervariasi dari bulan ke bulan dan bisa termasuk belanja makanan, transportasi, hiburan, pakaian, atau barang-barang lain yang dibutuhkan dalam kehidupan sehari-hari',
        ]);
        Kakeibo::create([
            'jenis' => 'Culture',
            'keterangan' => 'pengeluaran yang bertujuan untuk investasi jangka panjang',
        ]);
        Kakeibo::create([
            'jenis' => 'Extra',
            'keterangan' => 'dana yang dialokasikan untuk keadaan darurat atau kejadian tak terduga, seperti biaya medis tiba-tiba, perbaikan mendadak pada kendaraan atau peralatan rumah tangga, atau keadaan darurat lainnya.',
        ]);
    }

}
