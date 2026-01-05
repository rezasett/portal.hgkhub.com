<?php

namespace Database\Seeders;

use App\Models\GlosariumAccountElement;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       $data=[
            ['nama_akun' => 'Assets'],
            ['nama_akun' => 'Liabilities'],
            ['nama_akun' => 'Equity'],
            ['nama_akun' => 'Revenue'],
            ['nama_akun' => 'Expenses'],
            ['nama_akun' => 'All Accounts'],

        ];

         foreach ($data as $item) {
            GlosariumAccountElement::create($item);
        }
    }
}