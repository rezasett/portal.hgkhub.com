<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\memoPmpjTemp;

class PmpjTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pmpjItems = [
            ['order' => 1, 'pmpj_item' => 'Services User', 'status' => 'publish'],
            ['order' => 2, 'pmpj_item' => 'Deed of Establishment of the Company', 'status' => 'publish'],
            ['order' => 3, 'pmpj_item' => 'Ministry of Law and Human Rights Deed', 'status' => 'publish'],
            ['order' => 4, 'pmpj_item' => 'GMS Deed', 'status' => 'publish'],
            ['order' => 5, 'pmpj_item' => 'Taxpayer Identification Number', 'status' => 'publish'],
            ['order' => 6, 'pmpj_item' => 'Business Identification Number', 'status' => 'publish'],
            ['order' => 7, 'pmpj_item' => 'Company Registration Certificate', 'status' => 'publish'],
            ['order' => 8, 'pmpj_item' => 'License and Permits', 'status' => 'publish'],
            ['order' => 9, 'pmpj_item' => 'Financial Statements', 'status' => 'publish'],
            ['order' => 10, 'pmpj_item' => 'Bank Statements', 'status' => 'publish'],
        ];

        foreach ($pmpjItems as $item) {
            memoPmpjTemp::updateOrCreate(
                ['order' => $item['order']],
                $item
            );
        }
    }
}