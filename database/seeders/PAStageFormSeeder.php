<?php

namespace Database\Seeders;

use App\Models\MemoPAStageTemp;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PAStageFormSeeder extends Seeder
{
    public function run(): void
    {
     $data = [
            ['order' => '1',
             'title_stage' => 'Stage I: Client Acceptance',
             'description' => '',
             'item' => 'Risk analysis of engagement acceptance',
             'status' => 'publish',
            ],

            ['order' => '2',
             'title_stage' => 'Stage I: Client Acceptance',
             'description' => '',
             'item' => 'Letter of engagement',
             'status' => 'publish',
            ],

            ['order' => '3',
             'title_stage' => 'Stage I: Client Acceptance',
             'description' => '',
             'item' => 'Independent statement',
             'status' => 'publish',
            ],
            
            ['order' => '4',
             'title_stage' => 'Stage I: Client Acceptance',
             'description' => '',
             'item' => 'Communication with the engagement team',
             'status' => 'publish',
            ],
//stage 2
            ['order' => '5',
             'title_stage' => 'Stage II: Risk Assessment',
             'description' => '',
             'item' => 'Consideration of initial materiality',
             'status' => 'publish',
            ],

            ['order' => '6',
             'title_stage' => 'Stage II: Risk Assessment',
             'description' => '',
             'item' => 'Analytical procedures',
             'status' => 'publish',
            ],

            ['order' => '7',
             'title_stage' => 'Stage II: Risk Assessment',
             'description' => '',
             'item' => 'Understanding the entity and its environment',
             'status' => 'publish',
            ],

              ['order' => '8',
             'title_stage' => 'Stage II: Risk Assessment',
             'description' => '',
             'item' => 'Development of inherent risk',
             'status' => 'publish',
            ],

            ['order' => '9',
             'title_stage' => 'Stage II: Risk Assessment',
             'description' => '',
             'item' => 'Control risk/monitoring',
             'status' => 'publish',
            ],

            ['order' => '10',
             'title_stage' => 'Stage II: Risk Assessment',
             'description' => '',
             'item' => 'Communication with TCWG and SPI',
             'status' => 'publish',
            ],
//stage 3
            ['order' => '11',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Estimation of accounting procedure',
             'status' => 'publish',
            ],

            ['order' => '12',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Assessment of related party transactions',
             'status' => 'publish',
            ],

            ['order' => '13',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Substantive procedures',
             'status' => 'publish',
            ],

             ['order' => '14',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Evaluation of audit work',
             'status' => 'publish',
            ],

            ['order' => '15',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Management commitment and contingencies',
             'status' => 'publish',
            ],

            ['order' => '16',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Going concern asessment',
             'status' => 'publish',
            ],
            
            ['order' => '17',
             'title_stage' => 'Stage III: Risk Responses',
             'description' => '',
             'item' => 'Identification of material misstatements',
             'status' => 'publish',
            ],
//section iv
             ['order' => '18',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Evaluation of final materiality',
             'status' => 'publish',
            ],

             ['order' => '19',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Final analytical procedure',
             'status' => 'publish',
            ],

             ['order' => '20',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Communication with TCWG',
             'status' => 'publish',
            ],

             ['order' => '21',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Review of financial statement procedures',
             'status' => 'publish',
            ],

             ['order' => '22',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Evaluation of audit evidence',
             'status' => 'publish',
            ],

             ['order' => '23',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Review IAR',
             'status' => 'publish',
            ],

            ['order' => '24',
             'title_stage' => 'Stage IV: Reporting',
             'description' => '',
             'item' => 'Final Memorandum',
             'status' => 'publish',
            ],






            
            
           

        ];

        foreach ($data as $item) {
            MemoPAStageTemp::create($item);
        }
    }
}