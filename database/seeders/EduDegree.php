<?php

namespace Database\Seeders;

use App\Models\EducationDegree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EduDegree extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        $data = [
            [
                'degree_level' => 'Associate',
                'detail' => 'An associate degree is typically a two-year degree awarded by community colleges, junior colleges, and some four-year colleges and universities.',
            ],
            [
                'degree_level' => 'Bachelor',
                'detail' => 'A bachelor\'s degree is a four-year undergraduate degree awarded by colleges and universities.',
            ],
            [
                'degree_level' => 'Master',
                'detail' => 'A master\'s degree is a graduate degree that typically requires one to three years of study beyond a bachelor\'s degree.',
            ],
            [
                'degree_level' => 'Doctorate',
                'detail' => 'A doctorate is the highest academic degree awarded by universities, typically requiring several years of research and study beyond a master\'s degree.',
            ],
            [
                'degree_level' => 'Diploma',
                'detail' => 'A diploma is a document certifying the completion of a course of study, often at the high school or vocational level.',
            ],
            
        ];

        foreach ($data as $item) {
            EducationDegree::create($item);
        }
    }
}
