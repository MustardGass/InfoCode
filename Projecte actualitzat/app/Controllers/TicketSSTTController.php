<?php

namespace App\Controllers;
use App\Models\TiquetModel;
use App\Models\TipusDispositiuModel;

use App\Controllers\BaseController;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketSSTTController extends BaseController
{
    public function vista_ticket_sstt()
    {
       // Model tiquet
       $tiquetModel = new TiquetModel();
       $modelTipus_dispositiu = new TipusDispositiuModel();

       // Configurar KpaCrud
       $config = [
           'numerate' => false,
           'editable' => true,
           'removable' => true,
           'add_button' => true,
           // hi ha més configuració ademés d'aquesta
       ];

       // Crear instancia KpaCrud
       $crud = new KpaCrud();
       $crud->setConfig($config);

       // $tipus_tiquet = $tiquetModel->obtindreID();

       $crud->setTable('tiquet'); // Nom de la taula
       $crud->setPrimaryKey('id_tiquet'); // Clau primària
       $crud->setRelation('idFK_dispositiu', 'tipus_dispositiu', 'id_tipus', 'tipus'); //relacio entre taula tiquet i tipus_dispositiu
       $crud->setRelation('idFK_codiCentre_emitent', 'centre', 'codi_centre', 'nom');
    //    $crud->setRelation('idFK_codiCentre_reparador', 'centre', 'codi_centre', 'nom');

       // Columnes que volem veure
       $crud->setColumns(['id_tiquet', 'tipus_dispositiu__tipus', 'descripcio_avaria', 'centre__nom', 'centre_reparador', 'codi_equip', 'data_alta', 'estat_tiquet']);
       $crud->setColumnsInfo([
           'id_tiquet' => [
               'name' => 'Codi del tiquet'
           ],
           'tipus_dispositiu__tipus' => [
               'name' => 'Tipus de dispositiu'
           ],
           'descripcio_avaria' => [
               'name' => 'Descripció'
           ],
           'centre__nom' => [
               'name' => 'Centre emisor'
           ],
           'centre_reparador' => [
               'name' => 'Centre taller'
           ],
           'data_alta' => [
               'name' => 'Data creació'
           ],
           'estat' => [
               'name' => 'Estat'
           ],
           'idFK_dispositiu'=> [
            'name' => 'Tipus de dispositiu'
           ]
       ]);

    //    $crud->addItemFunction('mailing', 'fa-paper-plane', array($this, 'myCustomPage'), "Send mail");

       // Generar la taula KpaCrud
       $data['table'] = $crud->render();

       // Passar dades a la vista
       return view('pages/TicketSSTT', $data);
    }

    public function guardarDades() {
    
    }

}
