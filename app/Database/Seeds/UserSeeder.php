<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $db      = \Config\Database::connect();
        $builder = $db->table('user');

        $data = [
            [
                'username' => 'admin',
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'nama_admin' => 'Glen Henderson',
                'id_level' => '1'
            ],
            [
                'username' => 'loket',
                'password' => password_hash('12345678', PASSWORD_DEFAULT),
                'nama_admin' => 'Mulyadi Henderson',
                'id_level' => '2'
            ]
        ];

        $builder->insertBatch($data);
    }
}
