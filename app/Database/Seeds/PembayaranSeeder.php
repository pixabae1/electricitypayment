<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('pembayaran');

        $data = [
            [
                'id_tagihan' => '1',
                'id_pelanggan' => '1',
                'tanggal_pembayaran' => '2024-02-01',
                'bulan_bayar' => '01',
                'biaya_admin' => '2500',
                'total_bayar' => '64000',
                'id_user' => '2',
            ],
            [
                'id_tagihan' => '2',
                'id_pelanggan' => '2',
                'tanggal_pembayaran' => '2024-03-01',
                'bulan_bayar' => '02',
                'biaya_admin' => '2500',
                'total_bayar' => '90000',
                'id_user' => '2',
            ],
            [
                'id_tagihan' => '3',
                'id_pelanggan' => '3',
                'tanggal_pembayaran' => '2024-04-01',
                'bulan_bayar' => '03',
                'biaya_admin' => '2500',
                'total_bayar' => '108000',
                'id_user' => '2',
            ],
            [
                'id_tagihan' => '4',
                'id_pelanggan' => '4',
                'tanggal_pembayaran' => '2024-05-01',
                'bulan_bayar' => '04',
                'biaya_admin' => '2500',
                'total_bayar' => '126000',
                'id_user' => '2',
            ]
        ];

        $builder->insertBatch($data);
    }
}
