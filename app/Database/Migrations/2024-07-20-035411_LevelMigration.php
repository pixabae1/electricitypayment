<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LevelMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_level' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama_level' => [
                'type' => 'VARCHAR',
                'constraint' => 16,
            ],
        ]);
        $this->forge->addKey('id_level', true);
        $this->forge->addKey('nama_level', false, true);
        $this->forge->createTable('level');
    }

    public function down()
    {
        $this->forge->dropTable('level');
    }
}
