<?php

namespace App\Controllers;
use App\Models\TiquetModel;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketSSTTController extends BaseController
{
    public function vista_ticket_sstt()
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
        $crud->setColumns(['codi_equip', 'idFK_dispositiu', 'idFK_codiCentre']);

        // Generar la taula KpaCrud
        $data['table'] = $crud->render();

        // Passar dades a la vista
        return view('pages/TicketSSTT', $data);
    }
}
