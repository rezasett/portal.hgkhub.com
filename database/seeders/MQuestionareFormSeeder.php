<?php

namespace Database\Seeders;

use App\Models\MemoCpdQuestionareTemp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MQuestionareFormSeeder extends Seeder
{
    public function run(): void
    {
     $data = [
            ['section' => 'Previous Financial Reporting Issues',
             'questionare' => 'Existence of going concern issues',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            ['section' => 'Previous Financial Reporting Issues',
             'questionare' => 'Existence of financial restructuring',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            ['section' => 'Previous Financial Reporting Issues',
             'questionare' => 'Existence of recurring losses',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            ['section' => 'Previous Financial Reporting Issues',
             'questionare' => 'Existence of restatements',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            ['section' => 'Previous Financial Reporting Issues',
             'questionare' => 'Prior audit opinion other than unqualified',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            //ganti section
             ['section' => 'Management Integrity',
             'questionare' => 'Adverse reputation issues concerning management and the clients business',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
           
             ['section' => 'Management Integrity',
             'questionare' => 'Presence of irregularities in business operations',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],

            ['section' => 'Management Integrity',
             'questionare' => 'Aggressive interpretation of accounting standards and the control environment',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],

            ['section' => 'Management Integrity',
             'questionare' => 'Litigation risk with potential financial loss',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
           
             ['section' => 'Management Integrity',
             'questionare' => 'Indications of undue pressure on audit fee',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            
             ['section' => 'Management Integrity',
             'questionare' => 'Indications of unreasonable limitations on audit scope',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],

              ['section' => 'Management Integrity',
             'questionare' => 'Poor reputation of related parties with special relationships',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],

             ['section' => 'Management Integrity',
             'questionare' => 'Unreasonable grounds for auditor replacement',
             'risk_score' => 0,
             'eqr_priority' => 'low',
             'status' => 'publish',
            ],
            
            
           

        ];

        foreach ($data as $item) {
            MemoCpdQuestionareTemp::create($item);
        }
    }
}