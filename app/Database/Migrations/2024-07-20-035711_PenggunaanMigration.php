<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PenggunaanMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_penggunaan' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_pelanggan' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'bulan' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'tahun' => [
                'type' => 'YEAR',
            ],
            'meter_awal' => [
                'type' => 'INT',
            ],
            'meter_akhir' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addKey('id_penggunaan', true);
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('penggunaan');
    }

    public function down()
    {
        $this->forge->dropTable('penggunaan');
    }
}
