<?php

namespace App\Database\Seeds;

use App\Models\SSTTModel;
use CodeIgniter\Database\Seeder;

class SSTTDades extends Seeder
{
    public function run()
    {
        $csvFile = fopen(WRITEPATH."\dades\dadesSSTT.csv", "r");

        $firstLine = true;

        while(($data = fgetcsv($csvFile, 2000, ";")) !== false) {
            if(!$firstLine) {
                $model = new SSTTModel;
                $model->addSSTT($data[1], $data[2]);
            }
            $firstLine = false;
        }
        fclose($csvFile);
    }
}
