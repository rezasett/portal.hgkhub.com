<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemoMarginPercentage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MarginPercentageSeeder extends Seeder
{
    
        public function run(): void
    {
        $data = [
            ['name' => 'Margin Percentage 15%',
            'description' => '',
            'percentage' => 15.00,
            ],
            ['name' => 'Margin Percentage 35%',
            'description' => '',
            'percentage' => 35.00,
            ],
            ['name' => 'Margin Percentage 50%',
            'description' => '',
            'percentage' => 50.00,
            ],         
           

        ];

        foreach ($data as $item) {
            MemoMarginPercentage::create($item);
        }
    }
}