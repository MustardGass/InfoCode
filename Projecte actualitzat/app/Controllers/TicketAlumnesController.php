<?php

namespace App\Controllers;

use App\Controllers\BaseController;
// use App\Models\AlumnesModel;
use App\Models\EstatModel;
use App\Models\IntervencioModel;
use App\Models\ProfessorModel;

class TicketAlumnesController extends BaseController
{
    public function index()
    {
        $data['title'] = "pagina";
        $data['saludo'] = "Hola Bienvenido a la Plantilla 1 de CodeIgniter";
        return view("bienvenida", $data);
    }
    
    public function vista_layout() {

        // $model = new AlumnesModel();

        // $data['alumnes'] = $model->getAlumne();

        $data['titol_reparacions']= "Reparacions Assigandes";

        $professorModel = new ProfessorModel();
        $data['professors'] = $professorModel->select("nom AS nombre, cognoms AS cognom")
                                             ->orderBy("RAND()")
                                             ->limit(4)
                                             ->get()
                                             ->getResultArray();

        $intervencioModel = new IntervencioModel();
        $data['intervencions'] = $intervencioModel->select('*')
                                                  ->orderBy("RAND()")
                                                  ->limit(4)
                                                  ->get()
                                                  ->getResultArray(); 
        $estatModel = new EstatModel();
        $data['estats'] = $estatModel->select("estat AS estat")
                                    ->orderBy("RAND()")
                                    ->limit(4)
                                    ->get()
                                    ->getResultArray();

        return view('pages/TicketAlumnes', $data);
    }
}
