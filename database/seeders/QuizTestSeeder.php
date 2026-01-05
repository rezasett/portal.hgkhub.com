<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseMaterial;

class QuizTestSeeder extends Seeder
{
    public function run(): void
    {
        // Find a material to convert to quiz
        $material = CourseMaterial::where('type', 'text')->first();
        
        if ($material) {
            $quizData = [
                'questions' => [
                    [
                        'question' => 'Apa itu Laravel?',
                        'options' => [
                            'Framework PHP untuk pengembangan web',
                            'Database management system',
                            'Web server seperti Apache',
                            'Operating system untuk server'
                        ],
                        'correct_answer' => 0
                    ],
                    [
                        'question' => 'Komponen apa yang digunakan untuk routing di Laravel?',
                        'options' => [
                            'Controller',
                            'Model',
                            'Route',
                            'View'
                        ],
                        'correct_answer' => 2
                    ],
                    [
                        'question' => 'Apa kegunaan Artisan di Laravel?',
                        'options' => [
                            'Text editor untuk coding',
                            'Command line tool untuk development',
                            'Database server',
                            'Web server'
                        ],
                        'correct_answer' => 1
                    ],
                    [
                        'question' => 'Livewire digunakan untuk apa di Laravel?',
                        'options' => [
                            'Database connection',
                            'File storage',
                            'Building dynamic interfaces',
                            'Email sending'
                        ],
                        'correct_answer' => 2
                    ],
                    [
                        'question' => 'Apa ekstensi file untuk migration di Laravel?',
                        'options' => [
                            '.php',
                            '.sql',
                            '.json',
                            '.xml'
                        ],
                        'correct_answer' => 0
                    ]
                ],
                'passing_grade' => 70,
                'time_limit' => 15 // 15 minutes
            ];
            
            $material->update([
                'type' => 'quiz',
                'quiz_data' => json_encode($quizData),
                'title' => 'Kuis: Dasar-Dasar Laravel',
                'description' => 'Kuis untuk menguji pemahaman Anda tentang konsep dasar Laravel framework.',
                'points' => 50, // Higher points for quiz
                'duration_minutes' => 15
            ]);
            
            $this->command->info("Quiz material created successfully with ID: {$material->id}");
        } else {
            $this->command->warn('No text material found to convert to quiz');
        }
        
        // Create one more quiz material for another course
        $anotherMaterial = CourseMaterial::where('type', 'text')->skip(1)->first();
        
        if ($anotherMaterial) {
            $advancedQuizData = [
                'questions' => [
                    [
                        'question' => 'Apa itu Eloquent ORM di Laravel?',
                        'options' => [
                            'Database management tool',
                            'Object-Relational Mapping untuk database',
                            'Web server configuration',
                            'Template engine'
                        ],
                        'correct_answer' => 1
                    ],
                    [
                        'question' => 'Method mana yang digunakan untuk membuat relasi one-to-many?',
                        'options' => [
                            'belongsTo()',
                            'hasOne()',
                            'hasMany()',
                            'belongsToMany()'
                        ],
                        'correct_answer' => 2
                    ],
                    [
                        'question' => 'Apa fungsi dari middleware di Laravel?',
                        'options' => [
                            'Menyimpan data ke database',
                            'Filtering HTTP requests',
                            'Menampilkan views',
                            'Mengelola file uploads'
                        ],
                        'correct_answer' => 1
                    ]
                ],
                'passing_grade' => 80,
                'time_limit' => 10
            ];
            
            $anotherMaterial->update([
                'type' => 'quiz',
                'quiz_data' => json_encode($advancedQuizData),
                'title' => 'Kuis: Laravel Advanced',
                'description' => 'Kuis lanjutan untuk menguji pemahaman konsep Laravel yang lebih mendalam.',
                'points' => 75
            ]);
            
            $this->command->info("Advanced quiz material created successfully with ID: {$anotherMaterial->id}");
        }
    }
}
