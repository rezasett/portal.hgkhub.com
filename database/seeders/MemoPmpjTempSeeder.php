<?php

namespace Database\Seeders;

use App\Models\memoPmpjTemp;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemoPmpjTempSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $templates = [
            [
                'order' => '1',
                'pmpj_item' => 'Services User',
                'status' => 'publish',
            ],
             [
                'order' => '2',
                'pmpj_item' => 'Deed of Establishment of the Company',
                'status' => 'publish',
            ],
            
             [
                'order' => '3',
                'pmpj_item' => 'Ministry of Law and Human Rights Deed',
                'status' => 'publish',
            ],
            
             [
                'order' => '4',
                'pmpj_item' => 'GMS Deed',
                'status' => 'publish',
            ],

            
             [
                'order' => '5',
                'pmpj_item' => 'Taxpayer Identification Number',
                'status' => 'publish',
            ],
            
             [
                'order' => '6',
                'pmpj_item' => 'Business Identification Number',
                'status' => 'publish',
            ],
            
                         
            
        ];

        foreach ($templates as $template) {
            memoPmpjTemp::create($template);
        }
    }
}
