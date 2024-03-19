<?php

namespace App\Database\Seeds;

use App\Models\TipusDispositiuModel;
use CodeIgniter\Database\Seeder;

class DispositiuSeeder extends Seeder
{
    public function run()
    {
        $model = new TipusDispositiuModel;

        $tipus_dispositiu = ["Portátil", "SobreTaula", "Impressora", "Altres"];
        $num_registros = 20;

        shuffle($tipus_dispositiu); //Mezclar array

        for ($i = 0; $i < $num_registros; $i++) {
            $indice = array_rand($tipus_dispositiu);  // Obtener un índice aleatorio del array

            $model->addDispositius($tipus_dispositiu[$indice]);
        }
    }
}
