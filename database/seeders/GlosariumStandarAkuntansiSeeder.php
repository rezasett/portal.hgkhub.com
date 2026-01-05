<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\GlosariumStandarAkuntansi;

class GlosariumStandarAkuntansiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'standar_akuntansi' => 'SAK IFRS',
                'deskripsi' => '(Standar Akuntansi Keuangan)',
                'risk_score'     => 4,
                'eqr_priority'   => 'High'
            ],
            [
                'standar_akuntansi' => 'SAK ETAP',
                'deskripsi' => '(Standar Akuntansi Entitas Tanpa Akuntabilitas Publik)',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
            [
                'standar_akuntansi' => 'SAK EMKM',
                'deskripsi' => '(Standar Akuntansi untuk Usaha Mikro, Kecil, dan Menengah)',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
            [
                'standar_akuntansi' => 'SAK Syariah',
                'deskripsi' => '(Standar Akuntansi Syariah)',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
            [
                'standar_akuntansi' => 'SAP (Standar Akuntansi Pemerintahan)',
                'deskripsi' => '(Standar Akuntansi Pemerintahan)',
                'risk_score'     => 4,
                'eqr_priority'   => 'High'
            ],
            [
                'standar_akuntansi' => 'Standar Akuntasi Lainnya',
                'deskripsi' => '',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
        ];

        foreach ($data as $item) {
            GlosariumStandarAkuntansi::create($item);
        }
    }
}
