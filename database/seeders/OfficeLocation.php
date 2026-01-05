<?php

namespace Database\Seeders;

use App\Models\OfficeLocation as ModelsOfficeLocation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficeLocation extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'branch_name' => 'Palma Tower',
                'address' => 'Palma Tower 18th Floor Lot. F & G, Jl. RA. Kartini II-S Kav. 06, RT.6/RW.14, Pd. Pinang, Kec. Kebayoran Lama, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12310',
                'office_phone' => '(021) 75930431',
                'email' => 'info@hgkfirm.com',
            ],

             [
                'branch_name' => 'ITS Tower',
                'address' => ' Nifarro Park, ITS Tower 6th Floor, Jl. KH. Guru Amin No.18, RT.1/RW.1, Pejaten Timur, Ps. Minggu, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12510',
                'office_phone' => '-',
                'email' => 'info@hgkfirm.com',
            ],
             [
                'branch_name' => 'Bintaro',
                'address' => ' Ruko Graha Marcella (Belakang AW Resto), Jalan Utama Bintaro Sektor 3A, Pondok Aren, Kota Tangerang Selatan, Banten. Kode Pos : 15221.',
                'office_phone' => '-',  
                'email' => 'info@hgkfirm.com',
            ],
            
            
            // Add more degree as needed
        ];

        foreach ($data as $item) {
            ModelsOfficeLocation::create($item);
        }
    }
}