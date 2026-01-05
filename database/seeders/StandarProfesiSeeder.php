<?php

namespace Database\Seeders;

use App\Models\GlosariumStandarProfesi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StandarProfesiSeeder extends Seeder
{
    
     public function run(): void
    {
        $data = [
            [
                'nama_standar_profesi' => 'SPM',
                'description' => 'Standar Pengendalian Mutu',
           
            ],
             [
                'nama_standar_profesi' => 'SMM',
                'description' => 'Standar Manajemen Mutu',
               
            ],
             [
                'nama_standar_profesi' => 'Kerangka untuk Perikatan Asurans',
                'description' => 'Kerangka untuk Perikatan Asurans',
                
            ],
           [
                'nama_standar_profesi' => 'SA',
                'description' => 'Standar Audit',
              
            ],
             [
                'nama_standar_profesi' => 'SPR',
                'description' => 'Standar Perikatan Reviu ',
              
            ],
            [
                'nama_standar_profesi' => 'SPA',
                'description' => 'Standar Profesional Akuntan',
              
            ],
             [
                'nama_standar_profesi' => 'SJT',
                'description' => 'Standar Jasa Terkait',
              
            ],
             [
                'nama_standar_profesi' => 'SJI',
                'description' => 'Standar Jasa Investigasi',
              
            ],
             [
                'nama_standar_profesi' => 'SJK',
                'description' => 'Standar Jasa Konsultasi',
              
            ],
             [
                'nama_standar_profesi' => 'SJL',
                'description' => 'Standar Jasa Lain',
              
            ],
             [
                'nama_standar_profesi' => 'SJS',
                'description' => ' Standar Jasa Syariah',
              
            ],

        ];

        foreach ($data as $item) {
            GlosariumStandarProfesi::create($item);
        }
    }

}
