<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemoEngagementService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EngagementServiceSeeder extends Seeder
{
   
        public function run(): void
    {
     $data = [
            ['engagement_service_name' => 'Audit of Financial Reports (General Audit)',
             'detail' => 'Comprehensive audit services for financial statements.',
             'risk_score' => 0,
             'eqr_priority' => 'unknown',
            ],
            // ['engagement_service_name' => 'Review of Financial Reports',
            //  'detail' => 'Comprehensive review services for financial statements.',
            // ],
            //  ['engagement_service_name' => 'Audit of Agreed-Upon Procedures (AUP)',
            //  'detail' => 'Comprehensive audit services for agreed-upon procedures.',
            // ],
        
        ];

        foreach ($data as $item) {
            MemoEngagementService::create($item);
        }
    }
}