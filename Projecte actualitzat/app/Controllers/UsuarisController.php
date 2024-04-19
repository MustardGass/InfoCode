<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use App\Models\AlumnesModel;
use App\Models\CentreModel;
use App\Models\LoginModel;
use App\Models\ProfessorModel;
use App\Models\RolsModel;
use App\Models\UsersRolsModel;
use Faker\Factory;

class UsuarisController extends BaseController
{

    public function mostrar_pagina($pagina) {
        $data['title']="Pagina" . $pagina;
        return view("pagines/" . $pagina, $data);
    }

    public function registre() {
        //verificar si el usuari es admin
        if(session()->get('rol') !== 'admin') {
            return redirect()->to(base_url('login'));
        }
        
        helper("form");

        $modelProfessor = new ProfessorModel();
        $modelCentre = new CentreModel();
        $modelLogin = new LoginModel();
        $modelRols = new RolsModel();
        $model_UsersRols = new UsersRolsModel();

        // $modelAlumne = new AlumnesModel();
        
        $fake = Factory::create("es_ES");

        $validationRules = [
            'nom' => [
                'label' => 'nom',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El campo nom es obligatori'
                ]
            ],
            'cognoms' => [
                'label' => 'cognoms',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El camp cognoms es obligatori'
                ]
            ],
            'correu' => [
                'label' => 'correu',
                'rules' => 'required',
                'errors' => [
                    'required' => 'El camp correu es obligatori'
                ]
                ],
            'contrasenya' => [
                'label' => 'password',
                'rules' => 'required|min_length[8]',
                'errors' => [
                    'required' => 'El camp de contrasenya es obligatori',
                    'min_length' => '{field} massa curt'
                ]
            ]
        ];

        if($this->request->getMethod() === 'post') {
            if($this->validate($validationRules)) {
                $data = [
                    'id_xtec' => $fake->userName . "@xtec.cat",
                    'nom' => $this->request->getPost('nom'),
                    'cognoms' => $this->request->getPost('cognoms'),
                    'correu' => $this->request->getPost('correu'),
                    'idFK_codi_centre'=> $modelCentre->obtindreID()
                ];

                $modelProfessor->registrarProfessor($data);

                $pass_hash = password_hash($this->request->getPost('contrasenya'), PASSWORD_DEFAULT);
                $data['password'] = $pass_hash;
                $modelLogin->insert($data);

                //obtindre id del rol professor
                $rol_professor = $modelRols->where('tipus_rol', 'professor')->first();
                $idRol_professor = $rol_professor['id_rol'];

                //obtindre id del professor registrat
                $id_professor = $modelProfessor->where('correu', $data['correu'])->first()['id_xtec'];

                //guardar asociació del professor amb rol "professor" a la taula users_rols
                $data_UsersRols = [
                    'id_user' => $id_professor,
                    'idFK_rol' => $idRol_professor
                ];

                $model_UsersRols->insert($data_UsersRols);

                return redirect()->to(base_url("login"));
            }
        }

        return view("pagines/registre");
    }


    public function login() {

        helper("form");
        
            //info del post professor
            $id_admin = $this->request->getPost('usuari');
            $password = $this->request->getPost('contrasenya');

            $modelAdmin = new AdminModel();
            $datosUser = $modelAdmin->obtindreAdmin(['id_admin'=>$id_admin]);

            if(count($datosUser)>0){

                if(password_verify($password,$datosUser[0]['password'])){
    
                $data = [
                    "id_admin"=>$datosUser[0]['id_admin'],
                    'isLogged' => true
                ];

             $session = session();

             $session->set($data);
             $session->set('id_admin',$id_admin);

             return redirect()->to('/pagina/TicketSSTT');
            } else{
                return redirect()->to('/login');
            }
        }

        return view("pagines/login");
    }

    

    public function logout() {
        session()->destroy();
        return redirect()->to(base_url('login'));
    }

    public function vista_admin() {
        $data['titol'] = "Pagina de Administrador";
        return view('pages/Admin', $data);
    }


    public function mostrar_numero($numero) {
        $data['elnum'] = $numero;
        return view("pagines", $data);
    }

    // imprimir info dels alumnes
    // public function alumnes() {
    //     $model = new \App\Models\AlumnesModel();

    //     $data['title'] = "Alumnes";
    //     $data['alumne'] = $model->getAlumnes();
        
    //     return view("pagines/alumnes", $data);
    // }

}
