<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TiquetModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketProfessorsController extends BaseController
{
    public function vista_ticket_profes()
    {
        // Model tiquet
        $tiquetModel = new TiquetModel();

        // Configurar KpaCrud
        $config = [
            'editable' => true,
            'removable' => true,
            // hi ha més configuració ademés d'aquesta
        ];

        // Crear instancia KpaCrud
        $crud = new KpaCrud();
        $crud->setConfig($config);

        $data['tiquets'] = $tiquetModel->obtenirTiquets();

        $crud->setTable('tiquet'); // Nom de la taula
        $crud->setPrimaryKey('id_tiquet'); // Clau primària

        // Columnes que volem veure
        $crud->setColumns(['id_tiquet', 'codi_equip', 'data_alta', 'data_ultima_modificacio']);

        // Generar la taula KpaCrud
        $data['table'] = $crud->render();

        // Passar dades a la vista
        return view('pages/TicketProfessors', $data);
    }
}
