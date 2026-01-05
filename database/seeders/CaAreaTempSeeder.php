<?php

namespace Database\Seeders;

use App\Models\MemoCaArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CaAreaTempSeeder extends Seeder
{
   
    public function run(): void
    { 
        $names = [
            ['order' => '1','from_branch_id' => 1, 'name_area' => 'WIB', 'description' => 'Wilayah Indonesia Bagian Barat'],
            ['order' => '2', 'from_branch_id' => 1, 'name_area' => 'WITA', 'description' => 'Wilayah Indonesia Bagian Tengah'],
            ['order' => '3', 'from_branch_id' => 1, 'name_area' => 'WIT', 'description' => 'Wilayah Indonesia Bagian Timur'],
            ['order' => '4', 'from_branch_id' => 1, 'name_area' => 'WITA', 'description' => 'Wilayah Indonesia Bagian Tengah'],
            ['order' => '5', 'from_branch_id' => 1, 'name_area' => 'Trip A', 'description' => 'Perjalanan Trip A'],
            ['order' => '6', 'from_branch_id' => 1, 'name_area' => 'Trip B', 'description' => 'Perjalanan Trip B'],
            ['order' => '7', 'from_branch_id' => 1, 'name_area' => 'Trip C', 'description' => 'Perjalanan Trip C'],
            ['order' => '8', 'from_branch_id' => 1, 'name_area' => 'Trip D', 'description' => 'Perjalanan Trip D'],

            ['order' => '9','from_branch_id' => 2, 'name_area' => 'WIB', 'description' => 'Wilayah Indonesia Bagian Barat'],
            ['order' => '10', 'from_branch_id' => 2, 'name_area' => 'WITA', 'description' => 'Wilayah Indonesia Bagian Tengah'],
            ['order' => '11', 'from_branch_id' => 2, 'name_area' => 'WIT', 'description' => 'Wilayah Indonesia Bagian Timur'],
            ['order' => '12', 'from_branch_id' => 2, 'name_area' => 'WITA', 'description' => 'Wilayah Indonesia Bagian Tengah'],
            ['order' => '13', 'from_branch_id' => 2, 'name_area' => 'Trip A', 'description' => 'Perjalanan Trip A'],
            ['order' => '14', 'from_branch_id' => 2, 'name_area' => 'Trip B', 'description' => 'Perjalanan Trip B'],
            ['order' => '15', 'from_branch_id' => 2, 'name_area' => 'Trip C', 'description' => 'Perjalanan Trip C'],
            ['order' => '16', 'from_branch_id' => 2, 'name_area' => 'Trip D', 'description' => 'Perjalanan Trip D'],

            ['order' => '17','from_branch_id' => 3, 'name_area' => 'WIB', 'description' => 'Wilayah Indonesia Bagian Barat'],
            ['order' => '18', 'from_branch_id' => 3, 'name_area' => 'WITA', 'description' => 'Wilayah Indonesia Bagian Tengah'],
            ['order' => '19', 'from_branch_id' => 3, 'name_area' => 'WIT', 'description' => 'Wilayah Indonesia Bagian Timur'],
            ['order' => '20', 'from_branch_id' => 3, 'name_area' => 'WITA', 'description' => 'Wilayah Indonesia Bagian Tengah'],
            ['order' => '21', 'from_branch_id' => 3, 'name_area' => 'Trip A', 'description' => 'Perjalanan Trip A'],
            ['order' => '22', 'from_branch_id' => 3, 'name_area' => 'Trip B', 'description' => 'Perjalanan Trip B'],
            ['order' => '23', 'from_branch_id' => 3, 'name_area' => 'Trip C', 'description' => 'Perjalanan Trip C'],
            ['order' => '24', 'from_branch_id' => 3, 'name_area' => 'Trip D', 'description' => 'Perjalanan Trip D'],
        ];

        foreach ($names as $item) {
            MemoCaArea::create([
                'order' => $item['order'],
                'from_branch_id' => $item['from_branch_id'], // palma
                'name_area' => $item['name_area'],
                'description' => $item['description'],
                'accomodation_rate' => rand(10000, 100000),
                'transportation_rate' => rand(10000, 100000),
                'perdiem_rate' => rand(10000, 100000),
                'status' => 'publish',
            ]);
        }
    }
}
