<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TagihanMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tagihan' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_penggunaan' => [
                'type' => 'INT',
                'unsigned' => true,
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
            'jumlah_meter' => [
                'type' => 'INT',
            ],
            'status' => [
                'type' => 'ENUM',
                'constraint' => ['Lunas', 'Belum Lunas'],
                'default' => 'Belum Lunas',
            ],
        ]);
        $this->forge->addKey('id_tagihan', true);
        $this->forge->addForeignKey('id_penggunaan', 'penggunaan', 'id_penggunaan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tagihan');
    }

    public function down()
    {
        $this->forge->dropTable('tagihan');
    }
}
