<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\AdminModel;


class AddAdminSeeder extends Seeder
{
    public function run()
    {
        $model = new AdminModel();

        $model->addAdmin([
            'id_admin' => 'admin',
            'password' => password_hash('1234', PASSWORD_DEFAULT)
        ]);
    }
}
