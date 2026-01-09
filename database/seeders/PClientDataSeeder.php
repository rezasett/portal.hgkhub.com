<?php

namespace Database\Seeders;

use App\Models\PClientData;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PClientDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            ['client_name' => 'PT Maju Jaya Abadi', 'status' => 'ongoing'],
            ['client_name' => 'CV Sejahtera Makmur', 'status' => 'completed'],
            ['client_name' => 'PT Teknologi Nusantara', 'status' => 'ongoing'],
            ['client_name' => 'UD Berkah Sentosa', 'status' => 'cancleled'],
            ['client_name' => 'PT Global Solusi Indonesia', 'status' => 'ongoing'],
            ['client_name' => 'CV Karya Mandiri', 'status' => 'completed'],
            ['client_name' => 'PT Adira Finance', 'status' => 'ongoing'],
            ['client_name' => 'Bank Mandiri', 'status' => 'completed'],
            ['client_name' => 'PT Telkom Indonesia', 'status' => 'ongoing'],
            ['client_name' => 'PT Indofood Sukses Makmur', 'status' => 'ongoing'],
        ];

        foreach ($clients as $client) {
            PClientData::create($client);
        }
    }
}
