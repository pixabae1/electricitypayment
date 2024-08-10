<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call('LevelSeeder');
        $this->call('UserSeeder');
        $this->call('TarifSeeder');
        $this->call('PelangganSeeder');
        $this->call('PenggunaanSeeder');
        $this->call('TagihanSeeder');
        $this->call('PembayaranSeeder');
    }
}
