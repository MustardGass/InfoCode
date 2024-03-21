<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TablaRoles extends Migration
{
    public function up()
    {
        //Taula Dispositiu
        $this->forge->addField([
            'id_rol'  => [
                'type'  => 'INT',
                'constraint'    => 1,
                'auto_increment' => true
            ],
            'rol'    => [
                'type'  => 'VARCHAR',
                'constraint'    => 60,
                'null' => false

            ]
        ]);
        $this->forge->addKey("id_rol", true);
        $this->forge->createTable("rols");
    }

    public function down()
    {
        $this->forge->dropTable("rols");

    }
}
