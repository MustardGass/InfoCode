<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TiquetModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketProfessorsController extends BaseController
{
    public function vista_ticket_profes()
    {
        // Cargar modelo TiquetModel
        $tiquetModel = new TiquetModel();

        // Configurar KpaCrud
        $config = [
            'editable' => true,
            'removable' => true,
            // Aquí puedes agregar más configuraciones según tus necesidades
        ];

        // Crear instancia de KpaCrud
        $crud = new KpaCrud();
        $crud->setConfig($config);

        $data['tiquets'] = $tiquetModel->obtenirTiquets();

        $crud->setTable('tiquet'); // Establecer el nombre de la tabla
        $crud->setPrimaryKey('id_tiquet'); // Establecer la clave primaria

        // Configurar las columnas que deseas mostrar
        $crud->setColumns(['id_tiquet', 'codi_equip', 'descripcio_avaria', 'data_alta', 'data_ultima_modificacio', 'idFK_dispositiu', 'idFK_codiCentre', 'idFK_idProfessor']);

        // Generar la tabla con KpaCrud
        $data['table'] = $crud->render();

        // Pasar los datos a la vista
        return view('pages/TicketProfessors', $data);
    }
}
