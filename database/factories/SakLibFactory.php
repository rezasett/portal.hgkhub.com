<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SakLib>
 */
class SakLibFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $judul = fake()->sentence(4);
        return [
            'artikel_judul' => $judul,
            'artikel_slug' => Str::slug($judul) . '-' . fake()->unique()->randomNumber(4),
            'artikel_deskripsi' => fake()->paragraph(2),
            'artikel_files' => null, // File upload field
            'tags' => json_encode(fake()->words(5)),
            'index' => fake()->randomNumber(3),
            'status' => fake()->randomElement(['published', 'review', 'revised']),
            'penulis_id' => 1,
            'kategori_id' => 5, // SAK Library category
            'std_akuntansi_id' => fake()->numberBetween(1, 6), // glosarium_standar_akuntansis: 6
            'updated_by' => 1,
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
