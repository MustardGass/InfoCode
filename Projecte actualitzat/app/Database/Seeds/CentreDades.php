<?php

namespace App\Database\Seeds;

use App\Models\CentreModel;
use CodeIgniter\Database\Seeder;

class CentreDades extends Seeder
{
    public function run()
    {
        $centreFile = fopen(WRITEPATH."\dades\datosCentro.csv", "r");

        $firstLine = true;

        while (($data = fgetcsv($centreFile, 2000, ";")) !== false) {
            if (!$firstLine) {
                $model = new CentreModel;

                 $model->addCentre($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6], $data[7]);
                
            }
            $firstLine = false;
        }
        fclose($centreFile);
    }
}
