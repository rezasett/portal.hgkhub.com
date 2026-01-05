<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RaSubModulAuditTemp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubModulTempSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'order' => 1,
                'name_sub_modul_audit_temp' => 'Client Configuration',
           
            ],
             [
                'order' => 2,
                'name_sub_modul_audit_temp' => 'Materiality',
           
            ],
             [
                'order' => 3,
                'name_sub_modul_audit_temp' => 'Analytical Procedures',
           
            ],
             [
                'order' => 4,
                'name_sub_modul_audit_temp' => 'Inherent Risk',
           
            ],

            [
                'order' => 5,
                'name_sub_modul_audit_temp' => 'Control Risk',
           
            ],
            [
                'order' => 6,
                'name_sub_modul_audit_temp' => 'RoMM',
           
            ],

             [
                'order' => 7,
                'name_sub_modul_audit_temp' => 'Audit Strategy Memorandum',
           
            ],
             [
                'order' => 8,
                'name_sub_modul_audit_temp' => 'Lead & Sublead',
           
            ],
            [
                'order' => 9,
                'name_sub_modul_audit_temp' => 'Subsequent Event',
           
            ],
             [
                'order' => 10,
                'name_sub_modul_audit_temp' => 'Related Party Transaction',
           
            ],
             
             [
                'order' => 11,
                'name_sub_modul_audit_temp' => 'Accounting Estimate',
           
            ],
            [
                'order' => 12,
                'name_sub_modul_audit_temp' => 'Management Expert',
           
            ],
            [
                'order' => 13,
                'name_sub_modul_audit_temp' => "Auditor's Expert",
           
            ],

            [
                'order' => 14,
                'name_sub_modul_audit_temp' => 'List Adjusment',
           
            ],
            [
                'order' => 15,
                'name_sub_modul_audit_temp' => 'Trial Balance',
           
            ],
            [
                'order' => 16,
                'name_sub_modul_audit_temp' => 'Summary Unajusted Difference',
           
            ],
            [
                'order' => 17,
                'name_sub_modul_audit_temp' => 'QC Review',
           
            ],
            [
                'order' => 18,
                'name_sub_modul_audit_temp' => 'IAR Review',
           
            ],
            [
                'order' => 19,
                'name_sub_modul_audit_temp' => 'Final Review',
           
            ],
             

        ];

        foreach ($data as $item) {
            RaSubModulAuditTemp::create($item);
        }
    }
}
