<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Peliculas extends Migration
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
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => TRUE,
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('peliculas');

    }

    public function down()
    {
        $this->forge->dropTable('peliculas');
    }
}
