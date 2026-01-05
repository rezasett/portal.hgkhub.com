<?php

namespace Database\Seeders;

use App\Models\RaInherentRiskTemp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InherentTempSeeder extends Seeder
{
     /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data=[ 
            ['order'   => 1,
            'name'     => 'Is a transaction that occurs frequently',
            'status'   => 'publish'
            ],
            ['order'   => 2,
            'name'     => 'Misstatements corrected in prior periods (if any)',
            'status'   => 'publish'
            ],
            ['order'   => 3,
            'name'     => 'Vulnerable to changes in he bussiness environment',
            'status'   => 'publish'
            ],
            ['order'   => 4,
            'name'     => 'There are identified contingencie',
            'status'   => 'publish'
            ],
            ['order'   => 5,
            'name'     => 'Impact on losses',
            'status'   => 'publish'
            ],
            ['order'   => 6,
            'name'     => 'Accounts receive special attention for accounting or reporting',
            'status'   => 'publish'
            ],
            ['order'   => 7,
            'name'     => 'Account that have complexity',
            'status'   => 'publish'
            ],
            ['order'   => 8,
            'name'     => 'Significant realizable party transaction accounts',
            'status'   => 'publish'
            ],
            ['order'   => 9,
            'name'     => 'Accounts that use estimates',
            'status'   => 'publish'
            ],
            ['order'   => 10,
            'name'     => 'Significant Non-Routine Accounts',
            'status'   => 'publish'
            ],
            ['order'   => 11,
            'name'     => 'Vulnerable to fraud risk',
            'status'   => 'publish'
            ],
            ['order'   => 12,
            'name'     => 'Likelihood of Risk Occuring (H/L)',
            'status'   => 'publish'
            ],
            ['order'   => 13,
            'name'     => 'Magnitude/impact of Risk (H/L)',
            'status'   => 'publish'
            ],
             

            ];

        foreach ($data as $item) {
            RaInherentRiskTemp::create($item);
        }
    }
}
