<?php

namespace Database\Seeders;

use App\Models\RaMarginReference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarginRefSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            //om
            [
            "order"=> "1",
            "name"=> "Revenue",
            "type"=> "om",
            "percentage"=> "8% - 12%",
            ],

            [
            "order"=> "2",
            "name"=> "Earning Before Tax",
            "type"=> "om",
            "percentage"=> "3% - 5%",
            ],

            [
            "order"=> "3",
            "name"=> "Total Assets",
            "type"=> "om",
            "percentage"=> "1% - 2%",
            ],
            [
            "order"=> "4",
            "name"=> "Total Equity",
            "type"=> "om",
            "percentage"=> "1% - 3%",
            ],
            //pm
             [
            "order"=> "5",
            "name"=> "High",
            "type"=> "pm",
            "percentage"=> "70%",
            ],
            [
            "order"=> "6",
            "name"=> "Low",
            "type"=> "pm",
            "percentage"=> "80%",
            ],
            //sud
             [
            "order"=> "7",
            "name"=> "Margin Reference",
            "type"=> "sud",
            "percentage"=> "3%",
            ],
        ];

        foreach ($data as $item) {
            RaMarginReference::create($item);
        }
    }
}
