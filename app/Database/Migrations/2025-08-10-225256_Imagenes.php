<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Imagenes extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'imagen' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'extension' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'data' => [
                'type' => 'VARCHAR',
                'constraint' => 500,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('imagenes');
    }

    public function down()
    {
        $this->forge->dropTable('imagenes');
    }
}
