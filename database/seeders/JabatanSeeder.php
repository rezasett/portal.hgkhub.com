<?php

namespace Database\Seeders;

use App\Models\RoleJabatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['nama_role' => 'Admin', 'deskripsi' => 'Pengelola Sistem'],
            ['nama_role' => 'Junior Auditor', 'deskripsi' => 'Auditor Internal Pemula'],
            ['nama_role' => 'Senior Auditor', 'deskripsi' => 'Auditor Internal Senior'],
            ['nama_role' => 'SPV Auditor', 'deskripsi' => 'Supervisor Auditor'],
            ['nama_role' => 'Assistant Manager', 'deskripsi' => 'Asisten Manajer Audit'],
            ['nama_role' => 'Manager', 'deskripsi' => 'Manajer Audit'],
            ['nama_role' => 'Partner', 'deskripsi' => 'Akuntan Publik Perusahaan'],
            ['nama_role' => 'Klien', 'deskripsi' => 'Klien Perusahaan'],
        ];

        foreach ($data as $item) {
            RoleJabatan::create($item);
        }
    }
}
