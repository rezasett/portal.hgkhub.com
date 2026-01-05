<?php

namespace Database\Seeders;

use App\Models\GlosariumIndustri;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GIndustriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[ 
            ['nama_industri' => 'Pertanian perkebunan kehutanan peternakan kelautan perikanan',
            'risk_score'     => 4,
            'eqr_priority'   => 'High'
            ],
            ['nama_industri' => 'Pertambangan dan energi',
             'risk_score'     => 4,
            'eqr_priority'   => 'High'],
            ['nama_industri' => 'Properti dan Konstruksi',
             'risk_score'     => 4,
            'eqr_priority'   => 'High'],
            ['nama_industri' => 'Informasi komunikasi dan Transportasi',
             'risk_score'     => 4,
            'eqr_priority'   => 'High'],
            ['nama_industri' => 'Sektor Keuangan Perbankan',
            'risk_score'     => 4,
            'eqr_priority'   => 'High'],
            ['nama_industri' => 'Sektor Keuangan Asuransi dan Dana Pensiun',
            'risk_score'     => 4,
            'eqr_priority'   => 'High'],
            ['nama_industri' => 'Sektor Keuangan Lainnya',
            'risk_score'     => 4,
            'eqr_priority'   => 'High'],
            ['nama_industri' => 'Industri Pengolahan/Manufaktur',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'],
            ['nama_industri' => 'Perdagangan dan Jasa',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'],
            ['nama_industri' => 'Industri Lainnya',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'],
            ['nama_industri' => 'Pemerintahan Badan International',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'
            ],
            ['nama_industri' => 'Organisasi Non Profit',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'],
            ['nama_industri' => 'Non Industri Perorangan',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'],
            ['nama_industri' => 'General',
            'risk_score'     => 2,
            'eqr_priority'   => 'Low'],
            
            ];

        foreach ($data as $item) {
            GlosariumIndustri::create($item);
        }
    }
}
