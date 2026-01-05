<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CpdLetter;

class UpdateCpdLettersAutoIncrementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     * 
     * This seeder extracts auto increment numbers from existing letter_number_proposal
     * and populates the new auto_increment_number field for backward compatibility.
     */
    public function run(): void
    {
        $letters = CpdLetter::whereNotNull('letter_number_proposal')
            ->whereNull('auto_increment_number')
            ->get();

        foreach ($letters as $letter) {
            $autoIncrement = CpdLetter::extractAutoIncrementFromLetterNumber($letter->letter_number_proposal);
            
            if ($autoIncrement > 0) {
                $letter->update(['auto_increment_number' => $autoIncrement]);
                $this->command->info("Updated letter ID {$letter->id}: extracted auto increment {$autoIncrement} from {$letter->letter_number_proposal}");
            }
        }

        $this->command->info('Completed updating existing CpdLetter records with auto_increment_number.');
    }
}