<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\UserPointSummary;

class UserPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing users
        $users = User::all();

        foreach ($users as $user) {
            // Create initial user points summary record if not exists
            UserPointSummary::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'total_points' => 0,
                    'earned_today' => 0,
                    'level' => 1,
                    'next_level_points' => 100, // Points needed for next level
                ]
            );
        }

        // Give some sample points to admin user
        $admin = User::where('email', 'admin@example.com')->first();
        if ($admin) {
            $adminPoints = UserPointSummary::where('user_id', $admin->id)->first();
            if ($adminPoints) {
                $adminPoints->update([
                    'total_points' => 150,
                    'earned_today' => 25,
                    'level' => 2,
                    'next_level_points' => 250,
                ]);
            }
        }

        // Give some sample points to instructor
        $instructor = User::where('email', 'instructor@example.com')->first();
        if ($instructor) {
            $instructorPoints = UserPointSummary::where('user_id', $instructor->id)->first();
            if ($instructorPoints) {
                $instructorPoints->update([
                    'total_points' => 75,
                    'earned_today' => 15,
                    'level' => 1,
                    'next_level_points' => 100,
                ]);
            }
        }
    }
}