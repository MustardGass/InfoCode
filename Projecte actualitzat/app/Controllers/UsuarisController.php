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


    // public function registre() {
    //     helper("form");
    
    //     // $modelProfessor = new ProfessorModel();
    //     // $modelCentre = new CentreModel();
    //     // $modelRols = new RolsModel();
    //     $modelAdmin = new AdminModel();
    
    //     // $data['centre_profe'] = $modelCentre->select('codi_centre, nom')->findAll();
    
    //     // if($this->request->getMethod() === "post") {
    //     //     echo "El formulario se ha enviado correctamente."; // Agrega un echo para verificar que se llega a este punto
    //     //     $id_xtec = $this->request->getPost("correu_xtec");
    //     //     $nom = $this->request->getPost("nom");
    //     //     $cognoms = $this->request->getPost("cognoms");
    //     //     $correu = $this->request->getPost("correu_personal");
    //     //     $idFK_codi_centre = $this->request->getPost("centre");
    
    //     //     // Intenta guardar los datos en la base de datos
    //     //     $modelProfessor->registrarProfessor($id_xtec, $nom, $cognoms, $correu, $idFK_codi_centre);
    //     // }

    //     if($this->request->getMethod() === "post"){

    //         $modelAdmin->addAdmin([
    //             'id_admin' => $this->request->getPost("id_admin"),
    //             'password' => password_hash('1234', PASSWORD_DEFAULT)
    //         ]);
    //         // $id_admin = $this->request->getPost("id_admin");

    //         // $modelAdmin->registrarAdmin($id_admin);
    //     }
    //     echo "holaaaaaaaaaa";
    //     return view('pages/session/registre');
    // }
    
    

    public function registre() {
        //verificar si el usuari es admin
        // if(session()->get('rol') !== 'admin') {
        //     return redirect()->to(base_url('login'));
        // }
        
        $modelProfessor = new ProfessorModel();
        $modelCentre = new CentreModel();
        $modelLogin = new LoginModel();
        $modelRols = new RolsModel();
        $model_UsersRols = new UsersRolsModel();
        
        $modelAlumnes = new AlumnesModel();
        
        $fake = Factory::create("es_ES");
        $data['centre_profe'] = $modelCentre->select('codi_centre, nom')->findAll();

        if($this->request->getMethod() === 'POST') {

            $data = [
                'id_xtec' => $this->request->getPost('correu_xtec'),
                'nom' => $this->request->getPost('nom'),
                'cognoms' => $this->request->getPost('apellido'),
                'correu' => $this->request->getPost('correu'),
                'idFK_codi_centre'=> $this->request->getPost('centre')
            ];

            $modelProfessor->registrarProfessor($data);

            //guardar correu_xtec y password a la taula Login
            $data = [
                'idFK_user' => $this->request->getPost('correu_xtec'),
                'password' => $fake->password(6, 9)
            ];
            $modelLogin->registroUser($data);

            //Guardar correu_xtec y rol a la taula UsersRols
            $rolProfe = $modelRols->where('tipus_rol', 'professor')->first();
            $id_rol = $rolProfe['id_rol'];

            $data = [
                'idFK_user' => $this->request->getPost('correu_xtec'),
                'idFK_rol' => $id_rol
            ];

            $model_UsersRols->addUserRols($data);

            // $pass_hash = password_verify();
                // $pass_hash = password_hash($this->request->getPost('contrasenya'), PASSWORD_DEFAULT);
                // $data['password'] = $pass_hash;
                // $modelLogin->insert($data);


            return redirect()->to(base_url("login")); 
        }

        return view("pagines/registre", $data);
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
        $data['title'] = "Pagina de Administrador";
        return view('pages/admin', $data);
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
