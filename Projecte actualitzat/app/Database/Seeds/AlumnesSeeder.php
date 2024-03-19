<?php

namespace App\Database\Seeds;

use App\Models\AlumnesModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class AlumnesSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        $alumneFile = fopen(WRITEPATH."\dades\dadesAlumnes.csv", "r");
        $codis = [];

        $firstLine = true;

        $model = new AlumnesModel;

        while(($data = fgetcsv($alumneFile, 2000, ";")) !== false){
            if(!$firstLine) {
                $codis[] = $data;
            }
            $firstLine = false;
        }
        fclose($alumneFile);

        $total_lineas = count($codis);
        $codis_random = array_rand($codis, 50);

        foreach($codis_random as $idx) {
            $data = $codis[$idx];
            $correu_alumne = $fake->freeEmail();
            $model->addAlumnes($correu_alumne, $data);
        }
    }
}
