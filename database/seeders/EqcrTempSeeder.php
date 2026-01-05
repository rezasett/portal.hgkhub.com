<?php

namespace Database\Seeders;

use App\Models\MemoCpdEqcrTemp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EqcrTempSeeder extends Seeder
{
  public function run(): void 
    {
     $data = [
            ['order' => '1',
             'title_eqcr' => 'Previous Financial Reporting Issues',
             'description' => '',
             'item' => 'Public Entity',
             'scoring' => '10',
             'status' => 'publish',
            ],
              ['order' => '2',
             'title_eqcr' => 'Previous Financial Reporting Issues',
             'description' => '',
             'item' => 'Banking Industry/IKNB/SOE',
             'scoring' => '10',
             'status' => 'publish',
            ],
              ['order' => '3',
             'title_eqcr' => 'Previous Financial Reporting Issues',
             'description' => '',
             'item' => 'Litigation Risk',
             'scoring' => '10',
             'status' => 'publish',
            ],
            ['order' => '4',
             'title_eqcr' => 'Previous Financial Reporting Issues',
             'description' => '',
             'item' => 'Going Concern Issue',
             'scoring' => '10',
             'status' => 'publish',
            ],
             ['order' => '5',
             'title_eqcr' => 'Previous Financial Reporting Issues',
             'description' => '',
             'item' => 'First Engagement',
             'scoring' => '10',
             'status' => 'publish',
            ],
             ['order' => '6',
             'title_eqcr' => 'Previous Financial Reporting Issues',
             'description' => '',
             'item' => 'Audit Opinion Issue',
             'scoring' => '10',
             'status' => 'publish',
            ],

           

        ];

        foreach ($data as $item) {
            MemoCpdEqcrTemp::create($item);
        }
    }
}