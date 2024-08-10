<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PenggunaanSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('penggunaan');

        $data = [
            [
                'id_pelanggan' => '1',
                'bulan' => '01',
                'tahun' => '2024',
                'meter_awal' => '100',
                'meter_akhir' => '500',
            ],
            [
                'id_pelanggan' => '2',
                'bulan' => '02',
                'tahun' => '2024',
                'meter_awal' => '100',
                'meter_akhir' => '600',
            ],
            [
                'id_pelanggan' => '3',
                'bulan' => '03',
                'tahun' => '2024',
                'meter_awal' => '100',
                'meter_akhir' => '300',
            ],
            [
                'id_pelanggan' => '4',
                'bulan' => '04',
                'tahun' => '2024',
                'meter_awal' => '100',
                'meter_akhir' => '800',
            ]
        ];

        $builder->insertBatch($data);
    }
}
