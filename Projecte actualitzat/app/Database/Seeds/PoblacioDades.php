<?php

namespace App\Database\Seeds;

use App\Models\PoblacioModel;
use CodeIgniter\Database\Seeder;

class PoblacioDades extends Seeder
{
    public function run()
    {
        $PoblacioFile = fopen(WRITEPATH."\dades\dadesPoblacio.csv", "r");

        $firsLine = true;

        while(($data = fgetcsv($PoblacioFile, 2000, ";")) !== false) {
            if(!$firsLine) {
                $model = new PoblacioModel;
                $model->addPoblacio($data[0], $data[1], $data[2]);
            }
            $firsLine = false;
        }
        fclose($PoblacioFile);
    }
}
