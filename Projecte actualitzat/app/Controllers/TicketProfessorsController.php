<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TipusDispositiuModel;
use App\Models\TiquetModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketProfessorsController extends BaseController
{
    public function vista_ticket_profes()
    {
        if (!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }

        // //verificar si l'usuari té el rol de professor
        if(session()->get('user_rol') === 'Professor') {
            return redirect()->to(base_url('login'));
        }

        // Configurar KpaCrud
        $config = [
            'numerate' => false,
            'editable' => false,
            'removable' => false,
            'add_button' => false,
            // hi ha més configuració ademés d'aquesta
        ];

        // Crear instancia KpaCrud
        $crud = new KpaCrud();
        $crud->setConfig($config);

        // $tipus_tiquet = $tiquetModel->obtindreID();

        $crud->setTable('tiquet'); // Nom de la taula
        $crud->setPrimaryKey('id_tiquet'); // Clau primària
        $crud->setRelation('idFK_dispositiu', 'tipus_dispositiu', 'id_tipus', 'tipus'); //relacio entre taula tiquet i tipus_dispositiu

        // Columnes que volem veure
        $crud->setColumns(['codi_equip', 'tipus_dispositiu__tipus', 'descripcio_avaria', 'estat_tiquet']);

        $crud->setColumnsInfo([
            'codi_equip' => [
                'name' => 'Codi del equip'
            ],
            'tipus_dispositiu__tipus' => [
                'name' => 'Tipus de dispositiu',
                'width' => '20%' // Ajustar el ancho del campo
            ],
            'descripcio_avaria' => [
                'name' => 'Descripció',
                'width' => '40%' // Ajustar el ancho del campo
            ],
            'estat_tiquet' => [
                'name' =>  'Estat'
            ]
        ]);

        // Generar la taula KpaCrud
        $data['table'] = $crud->render();

        // Passar dades a la vista
        return view('pages/TicketProfessors', $data);

    }

}
