<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TarifMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_tarif' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'daya' => [
                'type' => 'INT',
            ],
            'tarifperkwh' => [
                'type' => 'INT',
            ],
        ]);
        $this->forge->addKey('id_tarif', true);
        $this->forge->addKey('daya', false, true);
        $this->forge->createTable('tarif');
    }

    public function down()
    {
        $this->forge->dropTable('tarif');
    }
}
