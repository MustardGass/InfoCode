<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AfegirTaulesNoves extends Migration
{
    public function up()
    {

        //taule de admin
        $this->forge->addField([
            'id_admin' => [
                'type'  => 'VARCHAR',
                'constraint' => 60
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ]
        ]);
        $this->forge->addKey('id_admin', true);
        $this->forge->createTable('administrador');


         //Taula Login
         $this->forge->addField([
            'id_login' => [
                'type' => 'INT',
                'constraint' => '18',
                'unsigned' => true,
                'auto_increment' => true
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '255'
            ]
        ]);

        $this->forge->addKey('id_login', true);
        $this->forge->createTable("login");

        //Taula Roles
        $this->forge->addField([
            'id_rol' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'tipus_rol' => [
                'type' => 'VARCHAR',
                'constraint' => '20',
            ]
        ]);

        $this->forge->addKey('id_rol', true);
        $this->forge->createTable("rols");

        //Taule User in Rols
        $this->forge->addField([
            'idFK_user' => [
                'type'  => 'VARCHAR',
                'constraint' => 60
            ],
            'idFK_rol' => [
                'type' => 'INT',
                'constraint' => 2,
                'unsigned' => true,
            ]
        ]);

        $this->forge->addKey("idFK_user", true);
        $this->forge->addForeignKey("idFK_user", "administrador", "id_admin");
        $this->forge->addForeignKey("idFK_rol", "rols", "id_rol");
        $this->forge->createTable("users_rols");
    }

    public function down()
    {
        $this->forge->dropTable("administrador");
        $this->forge->dropTable("login");
        $this->forge->dropTable("rols");
        $this->forge->dropTable("users_rols");
    }
}
