<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PelangganSeeder extends Seeder
{
    public function run()
    {
        helper('generateRandomNumber');

        $db      = \Config\Database::connect();
        $builder = $db->table('pelanggan');

        $data = [
            [
                'username' => 'jajang',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'nomor_kwh' => generateRandomNumber(),
                'nama_pelanggan' => 'Jajang Mulyana',
                'alamat' => 'Jonggol',
                'id_tarif' => '1',
            ],
            [
                'username' => 'udin',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'nomor_kwh' => generateRandomNumber(),
                'nama_pelanggan' => 'Udin Mulyana',
                'alamat' => 'Bogor',
                'id_tarif' => '1',
            ],
            [
                'username' => 'ely',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'nomor_kwh' => generateRandomNumber(),
                'nama_pelanggan' => 'Ely Suryani',
                'alamat' => 'Bekasi',
                'id_tarif' => '2',
            ],
            [
                'username' => 'maman',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'nomor_kwh' => generateRandomNumber(),
                'nama_pelanggan' => 'Maman Abdurahman',
                'alamat' => 'Jakarta',
                'id_tarif' => '1',
            ],
            [
                'username' => 'kusnaedi',
                'password' => password_hash('123', PASSWORD_DEFAULT),
                'nomor_kwh' => generateRandomNumber(),
                'nama_pelanggan' => 'Kusnaedi Jawara',
                'alamat' => 'Semarang',
                'id_tarif' => '2',
            ]
        ];

        $builder->insertBatch($data);
    }
}
