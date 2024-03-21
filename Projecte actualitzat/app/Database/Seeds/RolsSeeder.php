<?php

namespace App\Database\Seeds;
use App\Models\RolsModel;
use CodeIgniter\Database\Seeder;

class RolsSeeder extends Seeder
{
    public function run()
    {
        $model = new RolsModel;

        $rol = ["Admin", "Professor", "Alumne"];


        $model->registrarRols($rol);
    
    }
}
