<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemoFinancingStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FinancingSeeder extends Seeder
{
   
        public function run(): void
    {
     $data = [
            ['financing_status_name' => 'Bank debt from state-owned/regional-owned banks (Tbk and non-Tbk) and/or private banks with Tbk status',
             'detail' => 'Hutang Bank dari Bank BUMN/ BUMD (Tbk dan non Tbk) dan atau swasta status Tbk',
             'risk_score' => '4',
             'eqr_priority' => 'High',
            ],

            ['financing_status_name' => 'Financing Debt from State-Owned Enterprises/Regional-Owned Enterprises (Tbk and non-Tbk) and/or private companies with Tbk status',
             'detail' => 'Hutang Pembiayaan dari Perusahaan Pembiayaan BUMN/ BUMD (Tbk dan non Tbk) dan atau swasta status Tbk',
             'risk_score' => '4',
             'eqr_priority' => 'High',
            ],

            ['financing_status_name' => 'Bank debt from private banks with non-Tbk status',
             'detail' => 'Hutang Bank dari Bank swasta status Non Tbk',
             'risk_score' => '2',
             'eqr_priority' => 'Low',
            ],

            ['financing_status_name' => 'Financing Debt from Private Companies with Non-Tbk status',
             'detail' => 'Hutang Pembiayaan dari Perusahaan swasta status Non Tbk',
             'risk_score' => '2',
             'eqr_priority' => 'Low',
            ],
           

        ];

        foreach ($data as $item) {
            MemoFinancingStatus::create($item);
        }
    }
}