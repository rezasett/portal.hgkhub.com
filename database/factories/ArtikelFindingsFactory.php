<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArtikelFindings>
 */
class ArtikelFindingsFactory extends Factory
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
            'artikel_kondisi' => fake()->paragraph(1),
            'artikel_kriteria' => fake()->paragraph(1),
            'artikel_impact' => fake()->paragraph(1),
            'artikel_rekomendasi' => fake()->paragraph(2),
            'nama_klien' => fake()->company(),
            'periode' => fake()->year(),
            'tags' => json_encode(fake()->words(5)),
            'index' => fake()->randomNumber(3),
            'status' => fake()->randomElement(['published', 'review', 'revised']),
            'penulis_id' => 1,
            'kategori_id' => 2, // Findings category
            'glosarium_account_element_id' => fake()->numberBetween(1, 6), // glosarium_account_elements: 6
            'glosarium_lead_account_id' => fake()->numberBetween(1, 39), // glosarium_lead_accounts: 39
            'glosarium_industris_id' => fake()->numberBetween(1, 14), // glosarium_industris: 14
            'assertion_id' => fake()->numberBetween(1, 6), // assertions: 6
            'std_akuntansi_id' => fake()->numberBetween(1, 6), // glosarium_standar_akuntansis: 6
            'updated_by' => 1,
            'created_at' => fake()->dateTimeBetween('-6 months', 'now'),
            'updated_at' => fake()->dateTimeBetween('-3 months', 'now'),
        ];
    }
}
