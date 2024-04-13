<?php

namespace App\Database\Seeds;

use App\Models\CentreModel;
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
        $centreModel = new CentreModel();

        while(($data = fgetcsv($tiquetFile, 2000, ";")) !== false) {
            if(!$firstLine) {
                $codis[] = $data;   //almacenar lineas en array codis[].
            }
            $firstLine = false;
        }
        fclose($tiquetFile);

        //obtener codi_centre randoms
        $total_lineas = count($codis);
        $codis_random = array_rand($codis, 5);
        $arr_estat =["Reparat", "Pendent", "Cancel·lat"];
        // $num_registros = 5;
        // shuffle($arr_estat);

        foreach($codis_random as $idx){
            $data = $codis[$idx];
            $id_tiquet = $fake->randomNumber(5, true);
            $codi_equip = $fake->randomNumber(5, true);
            $descripcio_avaria = $fake->text();
            $data_alta = $fake->dateTimeBetween('2020-01-01', '+1 year')->format('Y_m_d H:i:s');
            $data_ultim_modif = $fake->dateTimeBetween($data_alta, '+1 month')->format('Y_m_d');
            $estat_tiquet = $arr_estat[array_rand($arr_estat)];
            $centre_emitent = $centreModel->obtindreNomCentreEmitent();
                do {
                    $centre_reparador = $centreModel->obtindreNomCentreRepador();
                } while($centre_emitent === $centre_reparador);



            //obtindre idFK_centre
            $idFK_codiCenctre_emitent = $centreModel->obtindreID();
            $idFK_codiCentre_reparador = $centreModel->obtindreID();

            //obtener idFK_dispositiu
            $idFK_dispositiu = $dispositiuModel->obtindreID();
            //obtener idFK_idProfessor
            $idFK_professor = $professorModel->obtindreID();

            $model->addTiquets($id_tiquet, $codi_equip, $descripcio_avaria, $data_alta, $data_ultim_modif, $estat_tiquet, $centre_emitent, $centre_reparador, $idFK_dispositiu, $idFK_codiCenctre_emitent, $idFK_codiCentre_reparador, $idFK_professor); 

        }
    }
}
