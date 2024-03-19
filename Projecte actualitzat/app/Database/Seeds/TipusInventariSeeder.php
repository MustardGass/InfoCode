<?php

namespace App\Database\Seeds;

use App\Models\TipusInventariModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class TipusInventariSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");
        $model = new TipusInventariModel;

        for($i = 0; $i < 10; $i++) {
            $tipus_inventari = $fake->text();

            $model->addTipusInventari($tipus_inventari);
        }
    }
}
