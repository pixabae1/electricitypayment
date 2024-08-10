<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PembayaranMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pembayaran' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'id_tagihan' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'id_pelanggan' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'tanggal_pembayaran' => [
                'type' => 'DATE',
            ],
            'bulan_bayar' => [
                'type' => 'VARCHAR',
                'constraint' => 2,
            ],
            'biaya_admin' => [
                'type' => 'INT',
            ],
            'total_bayar' => [
                'type' => 'INT',
            ],
            'id_user' => [
                'type' => 'INT',
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('id_pembayaran', true);
        $this->forge->addForeignKey('id_tagihan', 'tagihan', 'id_tagihan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_pelanggan', 'pelanggan', 'id_pelanggan', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('id_user', 'user', 'id_user', 'CASCADE', 'CASCADE');
        $this->forge->createTable('pembayaran');
    }

    public function down()
    {
        $this->forge->dropTable('pembayaran');
    }
}
