<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CentreModel;
use App\Models\RolsModel;
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
        $user_id = session()->get('user_id');
        $user_rol = session()->get('user_rol');
        $user_nom = session()->get('user_nom');
        $user_cognoms = session()->get('user_cognoms');
        $user_correu = session()->get('user_correu');
        $user_centre = session()->get('user_centre');
       
        $modelRols = new RolsModel();
        $rol = $modelRols->find($user_rol);

        $modelCentre = new CentreModel();
        $centre = $modelCentre->find($user_centre);

        
        $data['user_rol'] = $rol['tipus_rol'];
        $data['user_id'] = $user_id;
        $data['nom'] = $user_nom;
        $data['cognoms'] = $user_cognoms;
        $data['correu'] = $user_correu;
        $data['centre_assignat'] = $centre['nom'];

        return view("pages/professors/panelProfessor", $data);
    }
}
