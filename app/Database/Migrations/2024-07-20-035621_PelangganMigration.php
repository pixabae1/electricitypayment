<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PelangganMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pelanggan' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'username' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'nomor_kwh' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
            'nama_pelanggan' => [
                'type' => 'VARCHAR',
                'constraint' => 32,
            ],
            'alamat' => [
                'type' => 'VARCHAR',
                'constraint' => 64,
            ],
            'id_tarif' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_pelanggan', true);
        $this->forge->addKey(['username', 'nomor_kwh'], false, true);
        $this->forge->addForeignKey('id_tarif', 'tarif', 'id_tarif', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pelanggan');
    }

    public function down()
    {
        $this->forge->dropTable('pelanggan');
    }
}
