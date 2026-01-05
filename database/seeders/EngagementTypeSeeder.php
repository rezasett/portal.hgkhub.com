<?php

namespace Database\Seeders;

use App\Models\MemoEngagementType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EngagementTypeSeeder extends Seeder
{
    
        public function run(): void
    {
     $data = [
            ['engagement_type_name' => 'New Engagement',
             'detail' => 'Engagement type for first year agreements.',
             'risk_score' => '4',
             'eqr_priority' => 'High',
            ],
             ['engagement_type_name' => 'Recurring Engagement',
             'detail' => 'Engagement type for recurring agreements.',
             'risk_score' => '2',
             'eqr_priority' => 'Low',
            ],
            
           

        ];

        foreach ($data as $item) {
            MemoEngagementType::create($item);
        }
    }
}