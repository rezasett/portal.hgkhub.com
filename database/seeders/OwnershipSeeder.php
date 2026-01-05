<?php

namespace Database\Seeders;

use App\Models\MemoOwnershipStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OwnershipSeeder extends Seeder
{
        public function run(): void
    {
        $data = [
            ['ownership_status_name' => 'Swasta - Go Public',
                'detail' => 'Publicly listed private company',
                'risk_score'     => 4,
                'eqr_priority'   => 'High'
            ],
            ['ownership_status_name' => 'Swasta - Non Public',
                'detail' => 'Privately held private company',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
            ['ownership_status_name' => 'Public Sector',
                'detail' => 'Government-owned entity',
                'risk_score'     => 4,
                'eqr_priority'   => 'High'
            ],
            ['ownership_status_name' => 'BUMN/BUMD',
                'detail' => 'State-owned enterprise',
                'risk_score'     => 4,
                'eqr_priority'   => 'High'
            ],
            ['ownership_status_name' => 'Cooperative',
                'detail' => 'Cooperative business entity',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
            ['ownership_status_name' => 'Yayasan/LSM',
                'detail' => 'Foundation/Non-governmental organization',
                'risk_score'     => 2,
                'eqr_priority'   => 'Low'
            ],
           

        ];

        foreach ($data as $item) {
            MemoOwnershipStatus::create($item);
        }
    }
}
