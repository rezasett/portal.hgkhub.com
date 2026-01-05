<?php

namespace Database\Seeders;

use App\Models\RaCycleSettingTemp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CycleTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
      public function run(): void
    {
        $data = [
            [
                'order' => '1',
                'cycle_template' => 'sample',
                'cycle_name' => 'Loan',
                'Status' => 'active',
            ],
          
            [
                'order' => '2',
                'cycle_template' => 'sample',
                'cycle_name' => 'Finding',
                'Status' => 'active',
            ],
            [
                'order' => '3',
                'cycle_template' => 'sample',
                'cycle_name' => 'Investment',
                'Status' => 'active',
            ],
            [
                'order' => '4',
                'cycle_template' => 'sample',
                'cycle_name' => 'Fixed Asset',
                'Status' => 'active',
            ],
            [
                'order' => '5',
                'cycle_template' => 'sample',
                'cycle_name' => 'Payroll',
                'Status' => 'active',
            ]
            
            
        ];

        foreach ($data as $item) {
            RaCycleSettingTemp::create($item);
        }
    }
}
