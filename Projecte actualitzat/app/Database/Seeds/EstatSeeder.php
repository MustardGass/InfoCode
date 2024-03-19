<?php

namespace App\Database\Seeds;

use App\Models\EstatModel;
use CodeIgniter\Database\Seeder;
use Faker\Factory;

class EstatSeeder extends Seeder
{
    public function run()
    {
        $fake = Factory::create("es_ES");

        $model = new EstatModel;

        for($i = 0; $i < 20; $i++){
            $text = $fake->realText(20);
            $model->addEstat($text);
        }
    }
}
