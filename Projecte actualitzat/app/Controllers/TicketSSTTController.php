<?php

namespace App\Controllers;
use App\Models\TiquetModel;
use App\Models\TipusDispositiuModel;
use App\Models\CentreModel;
use App\Models\ProfessorModel;

use App\Controllers\BaseController;
use Faker\Factory;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketSSTTController extends BaseController
{
    public function vista_ticket_sstt()
    {
        if(!session()->get('isLogged')) {
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

    //    $id_tiquet = $tiquetModel->obtindreID();

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
           'codi_equip' => [
                'name' => 'Codi del equip'
           ],
           'data_alta' => [
               'name' => 'Data creació'
           ],
           'estat_tiquet' => [
               'name' => 'Estat'
           ],
           'idFK_dispositiu'=> [
            'name' => 'Tipus de dispositiu'
           ]
       ]);
       $crud->addItemLink('edit', 'fa-solid fa-pen text-success', base_url('pagina/editar/'), 'Editar ticket');
       $crud->addItemLink('delete','fa-solid fa-trash text-danger', base_url('pagina/eliminar/'), 'Eliminar ticket');
       
       // Generar la taula KpaCrud
       $data['table'] = $crud->render();
       
       // Passar dades a la vista
       return view('pages/TicketSSTT', $data);
    }
    
    
    public function afegir_ticket() {

        if(!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }

        $fake = Factory::create("es_ES");

        $data['titulo'] = "Afegir Ticket";

        $modelTiquet = new TiquetModel();
        $modelDispositiu = new TipusDispositiuModel();
        $modelCentre = new CentreModel();
        $modelProfessor = new ProfessorModel();

        $validationRules = [
            'cod_equip' => 'required'
        ];

        $n_rand1 = $fake->randomNumber(8, true);
        $n_rand2 = $fake->randomNumber(8, true);
        $idTicket = $n_rand1 . $n_rand2;
        
        $data_alta = date("Y-m-d H:i:s");
        $estat_tiquet = "Pendent";


        if($this->validate($validationRules)) {
            $codi_equip = $this->request->getPost('cod_equip');
            $dispositiu = $this->request->getPost('t_dispositiu');
            $descripcio_avaria = $this->request->getPost('descripcio');
            $idFK_Centre_emissor = $this->request->getPost('c_emitent');
            $idFK_centre_reparador = $this->request->getPost('c_reparador');
            $professor = $this->request->getPost('professor');

            $dispositiu_exists = $modelDispositiu->find($dispositiu);

            //obtindre nom del centre raparador
            //realitzar consulta per trobar el centre reparador amb la id proporcionada
            $centre_reparador = $modelCentre->find($idFK_centre_reparador);                //  $centre_reparador -> conté totes les dades del centre trobat
            $nom_centre_reparador = $centre_reparador['nom'];  //si se a trobat el centre, extraiem el nom de aquell centre


            if($dispositiu_exists){
                $modelTiquet->afegirTicket($idTicket, $codi_equip, $dispositiu, $descripcio_avaria, $data_alta, $estat_tiquet, $idFK_Centre_emissor, $idFK_centre_reparador, $professor, $nom_centre_reparador);
                return redirect()->to("pagina/TicketSSTT");
            } else {
                echo "Dispositivo seleccionado no existe";
            }
        }

        $data['tipus_dispositiu'] = $modelDispositiu->findAll();
        $data['centre_emitent'] = $modelCentre->select('codi_centre, nom')->findAll();
        $data['centre_reparador'] = $modelCentre->select('codi_centre, nom')->findAll();
        $data['professor'] = $modelProfessor->findAll();

        return view("pages/afegirTicket", $data);
    }

    //Vista eliminar tiquet
    public function eliminar_ticket($id_ticket){

        if(!session()->get('isLogged')) {
            return redirect()->to(base_url('login'));
        }

        $modelTiquet = new TiquetModel();
        $modelDispositiu = new TipusDispositiuModel();
        $modelCentre = new CentreModel();

        $ticket = $modelTiquet->find($id_ticket);   //buscar en la bd el id del tiquet que sera eliminado

        //Dispositiu
        $FK_dispositiu = $ticket['idFK_dispositiu'];    //obtener id del tipus_dispositiu del tiquet
        $dispositiu = $modelDispositiu->find($FK_dispositiu);   //buscar en la bd el id tipus_dispositiu anterior
        $tipus_dispositiu = $dispositiu['tipus'];   //obtener el campo tipus del id buscado, guarda el texto enves del num de la FK 

        //Centre
        $FK_centreEmissor = $ticket['idFK_codiCentre_emitent'];
        $centre_e = $modelCentre->find($FK_centreEmissor);
        $centre_emissor = $centre_e['nom'];

        $FK_centreReparador = $ticket['idFK_codiCentre_reparador'];
        $centre_r = $modelCentre->find($FK_centreReparador);
        $centre_reparador = $centre_r['nom'];


        $data['tiquet'] = $id_ticket;
        $data['codi_equip'] = $ticket['codi_equip'];
        $data['t_dispositiu'] = $tipus_dispositiu;
        $data['professor'] = $ticket['idFK_idProfessor'];
        $data['centre_emissor'] = $centre_emissor;
        $data['centre_reparador'] = $centre_reparador;

        return view("pages/eliminar", $data);
    }
    public function delete($id_ticket){
        $modelTiquet = new TiquetModel();
        $modelTiquet->borrarTicket($id_ticket);
        return redirect()->to("pagina/TicketSSTT");
    }

    public function editar_ticket($id_ticket) {

        //Crear instancies als models
        $modelTicket = new TiquetModel();
        $modelCentre = new CentreModel();
        $modelDispositiu = new TipusDispositiuModel();

        //buscar ticket especific amb el id proporcionat
        $ticket = $modelTicket->find($id_ticket);
        
        //pasar dades a la vista
        $data['ticket'] = $ticket['id_tiquet'];
        $data['dispositiu'] = $modelDispositiu->select('id_tipus, tipus')->findAll();
        $data['centre_emissor'] = $modelCentre->select('codi_centre, nom')->findAll();
        $data['codi_equip'] = (int)$ticket['codi_equip'];
        $data['descripcio_avaria'] = $ticket['descripcio_avaria'];
        $data['contable'] = $modelCentre->contarDatos();
        return view("pages/editarTicket", $data);
    }

    public function actualizar_ticket($id_ticket){
        
        $modelTicket = new TiquetModel();
        
        $cod_equip = $this->request->getPost('codi_equip');
        $descripcio_avaria  = $this->request->getPost('descripcio_avaria');
        $centre_emissor = $this->request->getPost('centreEmissor');
        $dispositiu = $this->request->getPost('t_dispositiu');

        $nou_ticket = [
            'codi_equip' => $cod_equip,
            'descripcio_avaria' => $descripcio_avaria,
            'idFK_dispositiu' => $dispositiu,
            'idFK_codiCentre_emitent' => $centre_emissor
        ];

        $modelTicket->editarTicket($id_ticket, $nou_ticket);

         return redirect()->to("pagina/TicketSSTT");
     }

}
