<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RaMarginReference;

class RaMarginReferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        RaMarginReference::truncate();

        // OM (Overall Materiality) References
        $omReferences = [
            ['order' => 1, 'name' => 'Revenue', 'type' => 'om', 'percentage' => '8% - 12%'],
            ['order' => 2, 'name' => 'Earning Before Taxes', 'type' => 'om', 'percentage' => '3% - 5%'],
            ['order' => 3, 'name' => 'Total Assets', 'type' => 'om', 'percentage' => '1% - 2%'],
            ['order' => 4, 'name' => 'Total Equity', 'type' => 'om', 'percentage' => '1% - 3%'],
        ];

        // PM (Performance Materiality) References
        $pmReferences = [
            ['order' => 1, 'name' => 'High', 'type' => 'pm', 'percentage' => '70%'],
            ['order' => 2, 'name' => 'Low', 'type' => 'pm', 'percentage' => '80%'],
        ];

        // SUD (Summary of Unadjusted Differences) References
        $sudReferences = [
            ['order' => 1, 'name' => 'Margin Reference', 'type' => 'sud', 'percentage' => '3%'],
        ];

        // Insert all references
        foreach ($omReferences as $reference) {
            RaMarginReference::create($reference);
        }

        foreach ($pmReferences as $reference) {
            RaMarginReference::create($reference);
        }

        foreach ($sudReferences as $reference) {
            RaMarginReference::create($reference);
        }

        $this->command->info('RaMarginReference seeded successfully!');
    }
}

