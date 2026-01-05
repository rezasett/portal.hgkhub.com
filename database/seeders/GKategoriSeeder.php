<?php

namespace Database\Seeders;

use App\Models\GlosariumKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =[
            ['nama_kategori' => 'SAK', 'deskripsi' => 'Kategori Standar Akuntansi Keuangan'],
            ['nama_kategori' => 'Findings', 'deskripsi' => 'Kategori Temuan Audit atau Pemeriksaan'],
            ['nama_kategori' => 'Procedures', 'deskripsi' => 'Kategori Prosedur atau Tata Cara'],
            ['nama_kategori' => 'Regulation', 'deskripsi' => 'Kategori Regulasi atau Peraturan'],
            ['nama_kategori' => 'SAK Libary', 'deskripsi' => 'Kategori Regulasi atau Peraturan'],
            ['nama_kategori' => 'SA Library', 'deskripsi' => 'Kategori Regulasi atau Peraturan'],
            ['nama_kategori' => 'Others', 'deskripsi' => 'Kategori Regulasi atau Peraturan'],
           
        ];

        foreach ($data as $item) {
            GlosariumKategori::create($item);
        }
    }
}
