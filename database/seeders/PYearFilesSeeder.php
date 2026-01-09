<?php

namespace Database\Seeders;

use App\Models\PYearFiles;
use App\Models\User;
use Illuminate\Database\Seeder;

class PYearFilesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first();
        
        if (!$user) {
            $this->command->error('No users found. Please create a user first.');
            return;
        }

        $years = [
            ['year' => 2020, 'status' => 'locked', 'locked_at' => '2021-01-15'],
            ['year' => 2021, 'status' => 'locked', 'locked_at' => '2022-01-20'],
            ['year' => 2022, 'status' => 'locked', 'locked_at' => '2023-02-10'],
            ['year' => 2023, 'status' => 'revise', 'locked_at' => null],
            ['year' => 2024, 'status' => 'active', 'locked_at' => null],
            ['year' => 2025, 'status' => 'active', 'locked_at' => null],
        ];

        foreach ($years as $yearData) {
            PYearFiles::firstOrCreate(
                ['year' => $yearData['year']],
                [
                    'status' => $yearData['status'],
                    'locked_at' => $yearData['locked_at'],
                    'created_by' => $user->id,
                ]
            );
        }

        $this->command->info('P Year Files seeded successfully!');
    }
}
