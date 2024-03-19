<?php

namespace App\Database\Seeds;

use App\Models\AlumnesModel;
use App\Models\IntervencioModel;
use App\Models\ProfessorModel;
use App\Models\TipusIntervencioModel;
use App\Models\TiquetModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class IntervencioSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        $model =  new IntervencioModel;
        $tipus_intervencioModel = new TipusIntervencioModel;
        $tiquetModel = new TiquetModel;
        $alumneModel = new AlumnesModel;
        $professorModel = new ProfessorModel;


        for($i = 0; $i < 10; $i++){
            $id_intervencio = $fake->randomNumber(8, true);
            $descripcio = $fake->text();
            $estudi_alumne = $fake->realText(80);
            $curs_alumne = $fake->realText(20);
            $data_intervencio = $fake->dateTimeBetween('2020-01-01', '+1 year')->format('Y_m_d H:i:s');

            //obtener idFK_intervencio
            $idFK_tipus_intervencio = $tipus_intervencioModel->obtindreID();
            $idFK_tiquet = $tiquetModel->obtindreID();
            $idFK_alumne = $alumneModel->obtindreID();
            $idFK_professor = $professorModel->obtindreID();

            $model->addIntervencio($id_intervencio, $descripcio, $estudi_alumne, $curs_alumne, $data_intervencio, $idFK_tipus_intervencio, $idFK_tiquet, $idFK_alumne, $idFK_professor);
        }
    }
}
