<?php

namespace Database\Seeders;

use App\Models\Assertion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssertionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nama_assertion' => 'Existence (keberadaan)',
                'slug' => 'existence-keberadaan',
                'description' => 'Description for Existence (keberadaan)',
            ],
            [
                'nama_assertion' => 'Completeness (kelengkapan)',
                'slug' => 'completeness-kelengkapan',
                'description' => 'Description for Completeness (kelengkapan)',
            ],
            [
                'nama_assertion' => 'Accuracy (ketepatan)',
                'slug' => 'accuracy-ketepatan',
                'description' => 'Description for Accuracy (ketepatan)',
            ],
            [
                'nama_assertion' => 'Valuation (penilaian)',
                'slug' => 'valuation-penilaian',
                'description' => 'Description for Valuation (penilaian)',
            ],
            [
                'nama_assertion' => 'Rights and Obligations (hak dan kewajiban)',
                'slug' => 'rights-and-obligations-hak-dan-kewajiban',
                'description' => 'Description for Rights and Obligations (hak dan kewajiban)',
            ],
            [
                'nama_assertion' => 'Presentation and Disclosure (penyajian dan pengungkapan)',
                'slug' => 'presentation-and-disclosure-penyajian-dan-pengungkapan',
                'description' => 'Description for Presentation and Disclosure (penyajian dan pengungkapan)',
            ],
            // Add more assertions as needed
        ];

        foreach ($data as $item) {
            Assertion::create($item);
        }
    }
}
