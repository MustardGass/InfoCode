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

        $modelProfessor = new ProfessorModel();
        $modelAlumne = new AlumnesModel();
        $modelAdmin = new AdminModel();

        if($this->request->getMethod() === 'post') {
            //info del post professor
            $correu = $this->request->getPost('usuari');
            $password = $this->request->getPost('contrasenya');

            //info post admin
            $usuari_admin = $modelAdmin->obtindreAdmin($correu);

                if(!$usuari_admin) {
                    $usuari_professor = $modelProfessor->obtindreProfessorID($correu);
                }

             //Buscar usuari per correu
            //  $usuari_professor = $modelProfessor->obtindreProfessorID($correu);

            //  //Si usuari no es professor
            // if(!$usuari_professor) {
            //     $usuari_alumne = $modelAlumne->obtindreAlumneID($correu);   //cercar en la taula alumnes per trobar si el usuari es alumne
            // }

            //verificar si usuari i contrasenya de admin son correctes
            if($usuari_admin && password_verify($password, $usuari_admin['password'])) {
                session()->set('isLogged', true);
                session()->set('user_id', $usuari_admin['id_admin']);

                return redirect()->to(base_url('pagina/TicketSSTT'));
            }elseif ($usuari_professor && password_verify($password, $usuari_professor['password'])) {
                session()->set('isLogged', true);
                session()->set('user_id', $usuari_professor['id_xtec']);

                return redirect()->to(base_url('pagina/TicketSSTT'));
            } else {
                $data['error'] = "Correu i contrasenya no son correctes";
            }
            
            // //verificar si usuari y contrasenya son correctes
            // if($usuari_professor && password_verify($password, $usuari_professor['password'])) {
            //     session()->set('isLogged', true);
            //     session()->set('user_id', $usuari_professor['id_xtec']);

            //     return redirect()->to(base_url("ticket/professor"));
            // } elseif($usuari_alumne && password_verify($password, $usuari_alumne['password'])){
            //     session()->set('isLogged', true);
            //     session()->set('user_id', $usuari_alumne['correu_alumne']);

            //     return redirect()->to(base_url("ticket/alumne"));
            // } else {
            //     $data['error'] = "Correu i contrasenya no son correctes";
            // }

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
