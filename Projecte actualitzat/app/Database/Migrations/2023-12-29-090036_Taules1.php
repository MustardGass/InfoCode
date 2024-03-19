<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Taules1 extends Migration
{
    public function up()
    {
        //Taula SSTT
        $this->forge->addField([
            'id_SSTT'    => [
                'type'      => 'VARCHAR',
                'constraint'    => 10
            ],
            'nom'   => [
                'type'      => 'VARCHAR',
                'constraint'  => '64',
            ],
            'direccio'  => [
                'type'  => 'VARCHAR',
                'constraint'    => '256',
            ],
            'telefon' => [
                'type'  => 'VARCHAR',
                'constraint'    => '15'
            ],
            'correu' => [
                'type'  => 'VARCHAR',
                'constraint'    => '64',
            ]
        ]);

        $this->forge->addKey("id_SSTT", true);
        $this->forge->createTable('SSTT');

        //Taula Centre
        $this->forge->addField([
            'codi_centre'   => [
                'type'  => 'INT',
                'constraint'    => 16,
                'unsigned'  => true,
            ],
            'nom'   => [
                'type'  => 'VARCHAR',
                'constraint'    => '64'
            ],
            'direccio'  => [
                'type'  => 'VARCHAR',
                'constraint'    => '100'
            ],
            'telefon'   => [
                'type'  => 'VARCHAR',
                'constraint'    => '15'
            ],
            'correu'    => [
                'type'  => 'VARCHAR',
                'constraint'    => '60'
            ],
            'poblacio'  => [
                'type'  => 'VARCHAR',
                'constraint'    => '60'
            ],
            'comarca'   => [
                'type'  => 'VARCHAR',
                'constraint'    => '60'
            ],
            // Com no hi han booleans, varia entre 0 i 1 on 0 és no actiu i 1 és actiu
            'actiu'     => [
                'type'  => 'INT',
                'constraint'    => '1'
            ],
            // Com no hi han booleans, varia entre 0 i 1 on 0 és no actiu i 1 és actiu
            'taller'    => [
                'type'  => 'INT',
                'constraint'    => '1'
            ],
            'idFK_SSTT' => [
                'type'  => 'VARCHAR',
                'constraint'    => 10
            ]  
        ]);
        $this->forge->addKey("codi_centre", true);
        $this->forge->addForeignKey("idFK_SSTT", "SSTT", "id_SSTT");
        $this->forge->createTable("centre");

        //Taula Comarca
        $this->forge->addField([
            'id_comarca'   => [
                'type'  => 'INT',
                'constraint'    => 4,
                'unsigned'  => true
            ],
            'nom_comarca'   => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ]
        ]);
        $this->forge->addKey("id_comarca", true);
        $this->forge->createTable("comarca");

         //Taule Poblacio
         $this->forge->addField([
            'id_poblacio'   => [
                'type'  => 'INT',
                'constraint'    => 4,
                'unsigned'  => true
            ],
            'nom_poblacio'   => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ],
            'idFK_Comarca' => [
                'type' => 'INT',
                'constraint' => 4,
                'unsigned' => true
            ]
        ]);
        $this->forge->addKey("id_poblacio", true);
        $this->forge->addForeignKey("idFK_Comarca", "comarca", "id_comarca");
        $this->forge->createTable("poblacio");

        //Taula Professor
        $this->forge->addField([
            'id_xtec'   => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ],
            'nom'   => [
                'type'  => 'VARCHAR',
                'constraint'    => '30'
            ],
            'cognoms'   => [
                'type'  => 'VARCHAR',
                'constraint'    => '60'
            ],
            'correu'    => [
                'type'  => 'VARCHAR',
                'constraint'    => '60'
            ],
            'idFK_codi_centre'  => [
                'type'  => 'INT',
                'constraint'    => 16,
                'unsigned'  => true
            ]
        ]);
        $this->forge->addKey("id_xtec", true);
        $this->forge->addForeignKey("idFK_codi_centre", "centre", "codi_centre");
        $this->forge->createTable("professor");

        //Taula Alumne
        $this->forge->addField([
            'correu_alumne' => [
                'type'  => 'VARCHAR',
                'constraint'    => 60
            ],
            'idFK_codi_centre'  => [
                'type'  => 'INT',
                'constraint'    => 16,
                'unsigned'  => true
            ]
        ]);
        $this->forge->addKey("correu_alumne");
        $this->forge->addForeignKey("idFK_codi_centre", "centre", "codi_centre");
        $this->forge->createTable("alumne");
    }

    public function down()
    {
        $this->forge->dropTable("SSTT");
        $this->forge->dropTable("comarca");
        $this->forge->dropTable("poblacio");
        $this->forge->dropTable("professor");
        $this->forge->dropTable("alumne");
    }
}
