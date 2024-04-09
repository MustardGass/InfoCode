<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfessorModel;
use App\Models\CentreModel;
use App\Models\LoginModel;
use App\Models\RolsModel;
use App\Models\UsersRolsModel;

use CodeIgniter\HTTP\ResponseInterface;
use Faker\Factory;

class UsuarisController extends BaseController
{

    public function mostrar_pagina($pagina) {
        $data['title']="Pagina" . $pagina;
        return view("pagines/" . $pagina, $data);
    }
    public function registre_professor() {
    
        //verificar si el usuari es admin
        if(session()->get('rol') !== 'admin') {
            return redirect()->to(base_url('login'));
        }

        $fake = Factory::create("es_ES");

        $modelProfessor = new ProfessorModel();
        $modelCentre = new CentreModel();

        helper("form");

        $model = new ProfessorModel;
        
        $dades = [
            "id_xtec" => $fake->companyEmail(),
            "nom" => $_POST["nom_cognom"],
            "cognoms" => $_POST["nom_cognom"],
            "correu" => $_POST["correu"],
            "idFK_codi_centre" => 0
        ];
        $model->registrarProfessor($dades);


        // if($_POST){

        //     $id_xtec = $fake->companyEmail();
        //     $nom = $_POST['nom_cognom'];
        //     $cognoms = $_POST['nom_cognom'];
        //     $correu = $_POST['correu'];
        //     $idFK_codi_centre = 0;

        //     $model->addProfessors($id_xtec, $nom, $cognoms, $correu, $idFK_codi_centre);
        //     return redirect()->to("/registre");
        // }   

        echo view("pagines/registre");
    }

    public function login() {
        return view("pagines/login");
    }

    public function mostrar_numero($numero) {
        $data['elnum'] = $numero;
        return view("pagines", $data);
    }

    //imprimir info dels alumnes
    public function alumnes() {
        $model = new \App\Models\AlumnesModel();

        $data['title'] = "Alumnes";
        $data['alumne'] = $model->getAlumne();
        
        return view("pagines/alumnes", $data);
    }

}
