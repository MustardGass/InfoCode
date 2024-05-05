<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class InformacioController extends BaseController
{
    public function info_sstt() {

        if(!session()->get('isLogged')){
            return redirect()->to(base_url('login'));
        }

        $data['title'] = "Informació de SSTT";

        // $user_id = session()->get('id_admin');

        return view("pages/sstt/panelSSTT", $data);
    }

    public function info_professor() {

        $data['title'] = "Informació de Professor";

        return view("pages/professors/panelProfessor", $data);
    }
}
