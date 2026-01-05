<?php

namespace Database\Seeders;

use App\Models\MemoOverheadPercentage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OverheadSeeder extends Seeder
{
   
        public function run(): void
    {
        $data = [
            ['name' => 'Margin Overhead 15%',
            'description' => '',
            'percentage' => 15.00,
            ],
            ['name' => 'Margin Overhead 35%',
            'description' => '',
            'percentage' => 35.00,
            ],
            ['name' => 'Margin Overhead 50%',
            'description' => '',
            'percentage' => 50.00,
            ],         
           

        ];

        foreach ($data as $item) {
            MemoOverheadPercentage::create($item);
        }
    }
}
