<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TicketProfessorsController extends BaseController
{
    public function index()
    {

        helper('language');

        $data['title'] = "pagina";
        $data['saludo'] = "Ticket professors";
        return view("bienvenida", $data);
    }
    
    public function vista_ticket_profes() {

        helper('language');

        $data['titol_reparacions']= "Reparacions Assigandes";
        return view('pages/TicketProfessors', $data);
    }
}
