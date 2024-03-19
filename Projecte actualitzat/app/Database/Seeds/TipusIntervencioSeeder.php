<?php

namespace App\Database\Seeds;

use App\Models\TipusIntervencioModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TipusIntervencioSeeder extends Seeder
{
    public function run()
    {

        $fake = Factory::create("es_ES");
        $model = new TipusIntervencioModel;

        for($i = 0; $i < 10; $i++){
            $id_tipus_intervencio = $fake->randomNumber(4, true);
            $tipus_intervencio = $fake->text();

            $model->addTipusIntervencio($id_tipus_intervencio, $tipus_intervencio);
        }
    }
}
