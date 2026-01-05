<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemoVatPercentage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VatPercentageSeeder extends Seeder
{
   
        public function run(): void
    {
        $data = [
            ['name' => 'Include VAT 11%',
            'description' => '',
            'percentage' => 11.00,
            ],
            ['name' => 'Include VAT 10%',
            'description' => '',
            'percentage' => 10.00,
            ],
            ['name' => 'Exclude VAT 0%',
            'description' => '',
            'percentage' => 0.00,
            ],         
           

        ];

        foreach ($data as $item) {
            MemoVatPercentage::create($item);
        }
    }
}