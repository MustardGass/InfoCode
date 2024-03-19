<?php

namespace App\Database\Seeds;

use App\Models\ProfessorModel;
use App\Models\TipusDispositiuModel;
use App\Models\TiquetModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TiquetSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        $tiquetFile = fopen(WRITEPATH."\dades\dadesTiquet.csv", "r");
        $codis = [];
        $firstLine = true;
        
        $model = new TiquetModel;
        $dispositiuModel = new TipusDispositiuModel;
        $professorModel = new ProfessorModel;

        while(($data = fgetcsv($tiquetFile, 2000, ";")) !== false) {
            if(!$firstLine) {
                $codis[] = $data;   //almacenar lineas en array codis[].
            }
            $firstLine = false;
        }
        fclose($tiquetFile);

        //obtener codi_centre randoms
        $total_lineas = count($codis);
        $codis_random = array_rand($codis, 15);

        foreach($codis_random as $idx){
            $data = $codis[$idx];
            $id_tiquet = $fake->randomNumber(5, true);
            $codi_equip = $fake->randomNumber(5, true);
            $descripcio_avaria = $fake->text();
            $data_alta = $fake->dateTimeBetween('2020-01-01', '+1 year')->format('Y_m_d H:i:s');
            $data_ultim_modif = $fake->dateTimeBetween($data_alta, '+1 month')->format('Y_m_d');

            //obtener idFK_dispositiu
            $idFK_dispositiu = $dispositiuModel->obtindreID();
            //obtener idFK_idProfessor
            $idFK_professor = $professorModel->obtindreID();

            $model->addTiquets($id_tiquet, $codi_equip, $descripcio_avaria, $data_alta, $data_ultim_modif, $idFK_dispositiu, $data, $idFK_professor); 

        }
    }
}
