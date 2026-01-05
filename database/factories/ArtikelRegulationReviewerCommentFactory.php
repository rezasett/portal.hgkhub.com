<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtikelRegulationReviewerComment>
 */
class ArtikelRegulationReviewerCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artikel_regulation_id' => \App\Models\ArtikelRegulations::factory(),
            'reviewer_id' => 1, // Assuming user ID 1 is a reviewer
            'komentar' => fake()->paragraph(2),
            'created_at' => fake()->dateTimeBetween('-2 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-1 month', 'now'),
        ];
    }
}
