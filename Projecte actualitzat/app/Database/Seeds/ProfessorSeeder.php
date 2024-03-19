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

        $total_lineas = count($codis);  //calcular total de lineas.
        $codis_random = array_rand($codis, 10);    //obtener 10  codigos randoms

        foreach($codis_random as $idx){   //idx-> contiene la posi de una linea random
            $data = $codis[$idx];   //contiene una linea random del array codis y esta linea es almacenada en $data
            $id_xtec = $fake->companyEmail();
            $nom = $fake->firstName();
            $cognoms = $fake->lastName();
            $correu = $fake->freeEmail();
            $model->addProfessors($id_xtec, $nom, $cognoms, $correu, $data);
        }
    }
}

