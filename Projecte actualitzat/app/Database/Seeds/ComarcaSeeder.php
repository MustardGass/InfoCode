<?php

namespace App\Database\Seeds;

use App\Models\ComarcaModel;
use CodeIgniter\Database\Seeder;

class ComarcaSeeder extends Seeder
{
    public function run()
    {
        $csvFile = fopen(WRITEPATH."\dades\dadesComarca.csv", "r");

        $firsLine = true;

        while(($data = fgetcsv($csvFile, 2000, ";")) !== false){
            if(!$firsLine) {
                $model = new ComarcaModel;
                $model->addComarca($data[0], $data[1]);
            }
            $firsLine = false;
        }
        fclose($csvFile);
    }
}
