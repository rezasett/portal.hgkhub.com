<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Course;
use App\Models\CourseEnrollment;
use App\Models\CourseMaterial;
use App\Models\CourseMaterialCompletion;
use App\Models\UserPointSummary;

class LeaderboardSampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get courses and users
        $courses = Course::all();
        $users = User::whereIn('role', ['preparer', 'reviewer'])->get();

        if ($courses->isEmpty() || $users->isEmpty()) {
            $this->command->info('No courses or users found. Run CourseSeeder first.');
            return;
        }

        // Create sample enrollments and completions
        foreach ($users as $user) {
            // Random number of courses to enroll (1-2 courses)
            $coursesToEnroll = $courses->random(rand(1, min(2, $courses->count())));
            
            foreach ($coursesToEnroll as $course) {
                // Create enrollment
                $enrollment = CourseEnrollment::firstOrCreate([
                    'user_id' => $user->id,
                    'course_id' => $course->id,
                ], [
                    'enrolled_at' => now()->subDays(rand(1, 30)),
                    'status' => 'active',
                ]);

                // Get course materials
                $materials = $course->materials;
                
                // Complete random materials (30-80% completion rate)
                $completionRate = rand(30, 80) / 100;
                $materialsToComplete = $materials->random(ceil($materials->count() * $completionRate));

                $totalPointsEarned = 0;

                foreach ($materialsToComplete as $material) {
                    $quizScore = null;
                    $points = $material->points;

                    // If it's a quiz material, generate random score
                    if ($material->type === 'quiz') {
                        $quizScore = rand(60, 100);
                        // Adjust points based on quiz score
                        $points = round($material->points * ($quizScore / 100));
                    }

                    // Create completion record
                    CourseMaterialCompletion::firstOrCreate([
                        'user_id' => $user->id,
                        'course_material_id' => $material->id,
                    ], [
                        'course_id' => $course->id,
                        'completed_at' => now()->subDays(rand(0, 20)),
                        'score' => $quizScore,
                        'points_earned' => $points,
                    ]);

                    $totalPointsEarned += $points;
                }

                // Update user's point summary
                $pointSummary = UserPointSummary::firstOrCreate(['user_id' => $user->id]);
                $pointSummary->addPoints($totalPointsEarned, "Course completion points for: {$course->title}");
            }
        }

        // Add some bonus points to make leaderboard more interesting
        $topUsers = User::whereIn('role', ['preparer', 'reviewer'])->inRandomOrder()->take(3)->get();
        
        foreach ($topUsers as $index => $user) {
            $bonusPoints = [100, 75, 50][$index]; // Different bonus amounts
            
            $pointSummary = UserPointSummary::firstOrCreate(['user_id' => $user->id]);
            $pointSummary->addPoints($bonusPoints, 'Bonus points for active participation');
        }

        $this->command->info('Sample leaderboard data created successfully!');
    }
}