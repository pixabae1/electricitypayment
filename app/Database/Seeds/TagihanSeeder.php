<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TagihanSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tagihan');

        $data = [
            [
                'id_penggunaan' => '1',
                'id_pelanggan' => '1',
                'bulan' => '01',
                'tahun' => '2024',
                'jumlah_meter' => '400',
                'status' => 'Lunas'
            ],
            [
                'id_penggunaan' => '2',
                'id_pelanggan' => '2',
                'bulan' => '02',
                'tahun' => '2024',
                'jumlah_meter' => '500',
                'status' => 'Belum Lunas'
            ],
            [
                'id_penggunaan' => '3',
                'id_pelanggan' => '3',
                'bulan' => '03',
                'tahun' => '2024',
                'jumlah_meter' => '200',
                'status' => 'Belum Lunas'
            ],
            [
                'id_penggunaan' => '4',
                'id_pelanggan' => '4',
                'bulan' => '04',
                'tahun' => '2024',
                'jumlah_meter' => '700',
                'status' => 'Lunas'
            ]
        ];

        $builder->insertBatch($data);
    }
}
