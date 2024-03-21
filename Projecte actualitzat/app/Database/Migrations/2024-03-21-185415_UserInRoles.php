<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserInRoles extends Migration
{
    public function up()
    {
        //Taula Dispositiu
        $this->forge->addField([
            'id_fk_id_rol'  => [
                'type'  => 'INT',
                'constraint'    => 1
            ],
            'id_fk_id_usuari'    => [
                'type'  => 'VARCHAR',
                'constraint'    => 60,
                'null' => false
            ]
        ]);
        $this->forge->addForeignKey("id_fk_id_rol", 'rols', 'id_rol');
        $this->forge->addForeignKey("id_fk_id_usuari");
        $this->forge->createTable("UserInRoles");
    }

    public function down()
    {
        $this->forge->dropTable("UserInRoles");

    }
}
