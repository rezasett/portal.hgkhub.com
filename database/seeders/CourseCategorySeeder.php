<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * Note: This seeder is prepared for future use when course categories 
     * need to be stored in a separate table instead of just as string fields.
     */
    public function run(): void
    {
        // This seeder is prepared for future implementation
        // Currently courses use simple category string field
        
        // Future implementation might include:
        /*
        $categories = [
            ['name' => 'Programming', 'slug' => 'programming', 'description' => 'Programming and coding courses'],
            ['name' => 'Web Development', 'slug' => 'web-development', 'description' => 'Web development courses'],
            ['name' => 'Mobile Development', 'slug' => 'mobile-development', 'description' => 'Mobile app development'],
            ['name' => 'Data Science', 'slug' => 'data-science', 'description' => 'Data science and analytics'],
            ['name' => 'Design', 'slug' => 'design', 'description' => 'UI/UX and graphic design'],
            ['name' => 'Marketing', 'slug' => 'marketing', 'description' => 'Digital marketing courses'],
            ['name' => 'Business', 'slug' => 'business', 'description' => 'Business and entrepreneurship'],
            ['name' => 'Finance', 'slug' => 'finance', 'description' => 'Finance and accounting'],
        ];

        foreach ($categories as $category) {
            CourseCategory::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
        */
    }
}