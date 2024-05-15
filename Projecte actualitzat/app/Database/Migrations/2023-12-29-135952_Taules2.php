<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Taules2 extends Migration
{
    public function up()
    {
         //Taula Dispositiu
         $this->forge->addField([
            'id_tipus'  => [
                'type'  => 'INT',
                'constraint'    => 4,
                'unsigned'  => true,
                'auto_increment' => true
            ],
            'tipus'    => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ]
        ]);
        $this->forge->addKey("id_tipus", true);
        $this->forge->createTable("tipus_dispositiu");


        //Taula Estat
        $this->forge->addField([
            'id_estat' => [
                'type'  => 'INT',
                'constraint'    => 4,
                'unsigned'  => true,                
                'auto_increment' => true
            ],
            'estat' => [
                'type'  => 'VARCHAR',
                'constraint'    => 20
            ]
        ]);
        $this->forge->addKey("id_estat", true);
        $this->forge->createTable("estat");

        //Taula Tiquet
        $this->forge->addField([
            'id_tiquet' => [
                'type' => 'BINARY',
                'constraint' => 16,
            ],
            'codi_equip' => [
                'type' => 'BINARY',
                'constraint' => 16
            ],
            'descripcio_avaria' => [
                'type' => 'TEXT',
                'null' => true
            ],
            'data_alta' => [
                'type' => 'DATETIME'
            ],
            'data_ultima_modificacio' => [
                'type' => 'DATETIME'
            ],
            'estat_tiquet' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'centre_reparador' => [
                'type' => 'VARCHAR',
                'constraint' => '100' 
            ],
            'idFK_dispositiu' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned'  => true,
            ],
            'idFK_codiCentre_emitent' => [
                'type' => 'INT',
                'constraint' => 16,
                'unsigned'  => true
            ],
            'idFK_codiCentre_reparador' => [
                'type' => 'INT',
                'constraint' => 16,
                'unsigned'  => true
            ],
            'idFK_idProfessor' => [
                'type' => 'VARCHAR',
                'constraint' => 60
            ]
        ]);
        $this->forge->addKey("id_tiquet", true);
        $this->forge->addForeignKey("idFK_dispositiu", "tipus_dispositiu", "id_tipus");
        $this->forge->addForeignKey("idFK_codiCentre_emitent", "centre", "codi_centre");
        $this->forge->addForeignKey("idFK_codiCentre_reparador", "centre", "codi_centre");
        $this->forge->addForeignKey("idFK_idProfessor", "professor", "id_xtec");
        $this->forge->createTable("tiquet");

        //Taula Tipus Intervenció
        $this->forge->addField([
            'id_tipus_intervencio'  => [
                'type'  => 'INT',
                'constraint'    => 4
            ],
            'tipus_intervencio'  => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ]
        ]);
        $this->forge->addKey("id_tipus_intervencio", true);
        $this->forge->createTable("tipus_intervencio");

        //Taula intervenció
        $this->forge->addField([
            'id_intervencio' => [
                'type'  => 'BINARY',
                'constraint' => 16,
            ],
            'descripcio' => [
                'type'  => 'TEXT',
            ],
            'estudi_alumne' => [
                'type'  => 'VARCHAR',
                'constraint' => 100
            ],
            'curs_alumne' => [
                'type'  => 'VARCHAR',
                'constraint' => 100
            ],
            'data_intervencio' => [
                'type' => 'DATE'
            ],
            'idFK_tipus_intervencio' => [
                'type'  => 'INT',
                'constraint'    => 4
            ],
            'idFK_tiquet' => [
                'type'  => 'BINARY',
                'constraint' => 16
            ],
            'idFK_alumne' => [
                'type'  => 'VARCHAR',
                'constraint' => 60
            ],
            'idFK_professor' => [
                'type'  => 'VARCHAR',
                'constraint' => 60
            ],
        ]);
        $this->forge->addKey("id_intervencio", true);
        $this->forge->addForeignKey("idFK_tipus_intervencio", "tipus_intervencio", "id_tipus_intervencio");
        $this->forge->addForeignKey("idFK_tiquet", "tiquet", "id_tiquet");
        $this->forge->addForeignKey("idFK_alumne", "alumne", "correu_alumne");
        $this->forge->addForeignKey("idFK_professor", "professor", "id_xtec");

        $this->forge->createTable("intervencio");

        //Taula Tipus Inventari
        $this->forge->addField([
            'id_tipus_inventari'   => [
                'type'  => 'INT',
                'constraint'    => 4,
                'auto_increment' => true
            ],
            'tipus_inventari'   => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ]
        ]);
        $this->forge->addKey("id_tipus_inventari", true);
        $this->forge->createTable("tipus_inventari");

        //Taula Inventari
        $this->forge->addField([
            'id_inventari'  => [
                'type'  => 'INT',
                'constraint'    => 5,
                'auto_increment' => true
            ],
            'data_compra'   => [
                'type'   => 'DATE'
            ],
            'preu'  => [
                'type'  => 'DECIMAL',
                'constraint'    => 10,2
            ],
            'idFK_tipus_inventari'  => [
                'type'  => 'INT',
                'constraint'    => 4
            ],
            'idFK_codi_centre'  => [
                'type'  => 'INT',
                'constraint'    => 16,
                'unsigned'  => true
            ],
            'idFK_intervencio'  => [
                'type'  => 'BINARY',
                'constraint'    => 16            
            ]
        ]);
        $this->forge->addKey("id_inventari", true);
        $this->forge->addForeignKey("idFK_tipus_inventari", "tipus_inventari", "id_tipus_inventari");
        $this->forge->addForeignKey("idFK_codi_centre", "centre", "codi_centre");
        $this->forge->addForeignKey("idFK_intervencio", "intervencio", "id_intervencio");
        $this->forge->createTable("inventari");
    }

    public function down()
    {
        $this->forge->dropTable("tipus_dispositiu");
        $this->forge->dropTable("estat");
        $this->forge->dropTable("tiquet");
        $this->forge->dropTable("tipus_intervencio");
        $this->forge->dropTable("intervencio");
        $this->forge->dropTable("tipus_inventari");
        $this->forge->dropTable("inventari");
    }
}
