<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class LevelSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('level');

        $data = [
            [
                'nama_level' => 'admin',
            ],
            [
                'nama_level' => 'officer',
            ],
        ];

        $builder->insertBatch($data);
    }
}
