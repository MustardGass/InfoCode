<?php

namespace App\Database\Seeds;

use App\Models\CentreModel;
use App\Models\IntervencioModel;
use App\Models\InventariModel;
use App\Models\TipusInventariModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class InventariSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        $model = new InventariModel;
        $tipus_inventariModel = new TipusInventariModel;
        $centreModel = new CentreModel;
        $intervencioModel = new IntervencioModel;

        for($i = 0; $i < 10; $i++)  {
            $data_compra = $fake->dateTimeBetween('2020-01-01', '+1 year')->format('Y_m_d H:i:s');
            $preu = $fake->randomFloat(2);

            //obtener idFK_tipus_inventari
            $idFK_tipus_inventari = $tipus_inventariModel->obtindreID();

            //obtener idFk_codiCentre
            $idFK_codiCentre = $centreModel->obtindreID();

            $idFk_intervencio = $intervencioModel->obtindreID();

            $model->addInventari($data_compra, $preu, $idFK_tipus_inventari, $idFK_codiCentre, $idFk_intervencio);
        }
    }
}
