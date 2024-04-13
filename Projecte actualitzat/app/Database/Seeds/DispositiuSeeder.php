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

        foreach($tipus_dispositiu as $dispositiu){
            $model->addDispositius($dispositiu);
        }
    }
}
