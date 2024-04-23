<?php

namespace App\Database\Seeds;

use App\Models\ProfessorModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class ProfessorSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");
        
        $profesorFile = fopen(WRITEPATH . "\dades\dadesProfessors.csv", "r");
        $codis = [];
        
        $firstLine = true;
        
        $model = new ProfessorModel();

        while(($data = fgetcsv($profesorFile, 2000, ";")) !== false) {
            if(!$firstLine) {
                $codis[] = $data;   //almacenar lineas en array codis
            }
            $firstLine = false;
        }
      
        fclose($profesorFile);

        $total_lineas = count($codis);  // Linies totals
        $codis_random = array_rand($codis, 10); // Obtindre 10 codis aleatoris

        foreach($codis_random as $idx){   //idx-> conté la posició d'una linia aleatoria
            $data = $codis[$idx];   //conté una linia aleatoria de l'array codis i s'emmagatzema a $data
            $id_xtec = $fake->companyEmail();
            $nom = $fake->firstName();
            $cognoms = $fake->lastName();
            $correu = $fake->freeEmail();
            $model->addProfessors($id_xtec, $nom, $cognoms, $correu, $data);
        }
    }
}

