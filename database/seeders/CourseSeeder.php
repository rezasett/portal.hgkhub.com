<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseMaterial;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create instructor user
        $instructor = User::where('email', 'instructor@example.com')->first();
        if (!$instructor) {
            // Get the first available jabatan_id
            $firstJabatan = DB::table('role_jabatans')->first();
            
            $instructor = User::create([
                'name' => 'Instructor Demo',
                'email' => 'instructor@example.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
                'status' => 'active',
                'jabatan_id' => $firstJabatan ? $firstJabatan->id : 1,
                'glosarium_industri_ids' => json_encode([]),
            ]);
        }

        // For now, we'll use null for category_id since learning_centers table doesn't exist yet
        $categoryId = null;

        // Create sample courses
        $courses = [
            [
                'title' => 'Dasar-dasar Pemrograman PHP',
                'slug' => 'dasar-dasar-pemrograman-php-' . time(),
                'description' => 'Pelajari dasar-dasar pemrograman PHP dari nol hingga mahir',
                'objectives' => 'Setelah menyelesaikan kursus ini, peserta akan mampu: 1) Memahami sintaks dasar PHP, 2) Membuat aplikasi web sederhana, 3) Mengelola database dengan PHP',
                'level' => 'beginner',
                'duration_hours' => 20,
                'instructor_id' => $instructor->id,
                'category' => 'Programming',
                'category_id' => $categoryId,
                'status' => 'published',
                'is_active' => true,
                'is_featured' => true,
            ],
            [
                'title' => 'Laravel Framework untuk Pemula',
                'slug' => 'laravel-framework-untuk-pemula-' . time(),
                'description' => 'Belajar framework Laravel untuk pengembangan aplikasi web modern',
                'objectives' => 'Menguasai konsep MVC, routing, eloquent ORM, dan fitur-fitur Laravel lainnya',
                'level' => 'intermediate',
                'duration_hours' => 30,
                'instructor_id' => $instructor->id,
                'category' => 'Web Development',
                'category_id' => $categoryId,
                'status' => 'published',
                'is_active' => true,
                'is_featured' => false,
            ],
        ];

        foreach ($courses as $courseData) {
            $course = Course::create($courseData);

            // Create materials for each course
            $this->createMaterialsForCourse($course);
        }
    }

    private function createMaterialsForCourse($course)
    {
        if ($course->title === 'Dasar-dasar Pemrograman PHP') {
            $materials = [
                [
                    'title' => 'Pengenalan PHP',
                    'content' => '<h2>Apa itu PHP?</h2><p>PHP adalah bahasa pemrograman server-side yang populer untuk pengembangan web...</p>',
                    'type' => 'text',
                    'points' => 10,
                    'order_index' => 1,
                    'is_required' => true,
                ],
                [
                    'title' => 'Instalasi dan Setup Environment',
                    'content' => '<h2>Cara Install PHP</h2><p>Untuk memulai programming PHP, kita perlu menginstall...</p>',
                    'type' => 'text',
                    'points' => 15,
                    'order_index' => 2,
                    'is_required' => true,
                ],
                [
                    'title' => 'Video: Sintaks Dasar PHP',
                    'content' => '<p>Video pembelajaran tentang sintaks dasar PHP</p>',
                    'type' => 'video',
                    'video_url' => 'https://example.com/video1',
                    'duration_minutes' => 30,
                    'points' => 20,
                    'order_index' => 3,
                    'is_required' => true,
                ],
                [
                    'title' => 'Quiz: Pemahaman Dasar PHP',
                    'content' => '<p>Quiz untuk menguji pemahaman dasar PHP</p>',
                    'type' => 'quiz',
                    'quiz_data' => [
                        'questions' => [
                            [
                                'question' => 'Apa kepanjangan dari PHP?',
                                'options' => [
                                    'Personal Home Page',
                                    'PHP: Hypertext Preprocessor',
                                    'Private Home Page',
                                    'Public Hypertext Protocol'
                                ],
                                'correct_answer' => 1
                            ],
                            [
                                'question' => 'Tag pembuka PHP yang benar adalah?',
                                'options' => [
                                    '<php>',
                                    '<?php',
                                    '<script>',
                                    '<%php%>'
                                ],
                                'correct_answer' => 1
                            ]
                        ]
                    ],
                    'points' => 25,
                    'order_index' => 4,
                    'is_required' => true,
                ],
            ];
        } else {
            // Laravel course materials
            $materials = [
                [
                    'title' => 'Pengenalan Laravel',
                    'content' => '<h2>Apa itu Laravel?</h2><p>Laravel adalah framework PHP yang elegant dan ekspresif...</p>',
                    'type' => 'text',
                    'points' => 10,
                    'order_index' => 1,
                    'is_required' => true,
                ],
                [
                    'title' => 'Instalasi Laravel',
                    'content' => '<h2>Cara Install Laravel</h2><p>Beberapa cara untuk menginstall Laravel...</p>',
                    'type' => 'text',
                    'points' => 15,
                    'order_index' => 2,
                    'is_required' => true,
                ],
                [
                    'title' => 'Routing dan Controller',
                    'content' => '<h2>Konsep Routing</h2><p>Routing adalah cara Laravel menangani URL...</p>',
                    'type' => 'text',
                    'points' => 20,
                    'order_index' => 3,
                    'is_required' => true,
                ],
            ];
        }

        foreach ($materials as $materialData) {
            $materialData['course_id'] = $course->id;
            CourseMaterial::create($materialData);
        }
    }
}
