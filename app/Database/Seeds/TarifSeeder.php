<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TarifSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('tarif');

        $data = [
            [
                'daya' => '450',
                'tarifperkwh' => '400',
            ],
            [
                'daya' => '900',
                'tarifperkwh' => '600',
            ]
        ];

        $builder->insertBatch($data);
    }
}
