<?php

namespace App\Models;

use CodeIgniter\Model;

class TiquetModel extends Model
{
    protected $table            = 'tiquet';
    protected $primaryKey       = 'id_tiquet';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_tiquet', 'codi_equip', 'descripcio_avaria', 'data_alta', 'data_ultima_modificacio', 'estat_tiquet', 'centre_emitent', 'centre_reparador', 'idFK_dispositiu', 'idFK_codiCentre_emitent', 'idFK_codiCentre_reparador', 'idFK_idProfessor'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addTiquets($id_tiquet, $codi_equip, $descripcio_avaria, $data_alta, $data_ultim_modif, $estat_tiquet, $centre_emitent, $centre_reparador, $idFK_dispositiu, $idFK_codiCentre_emitent, $idFK_codiCentre_reparador, $idFK_professor){
        $this->insert([
            'id_tiquet' => $id_tiquet,
            'codi_equip' => $codi_equip,
            'descripcio_avaria' => $descripcio_avaria,
            'data_alta' => $data_alta,
            'data_ultima_modificacio' => $data_ultim_modif,
            'estat_tiquet' => $estat_tiquet,
            'centre_emitent' => $centre_emitent,
            'centre_reparador' => $centre_reparador,
            'idFK_dispositiu' => $idFK_dispositiu,
            'idFK_codiCentre_emitent' => $idFK_codiCentre_emitent,
            'idFK_codiCentre_reparador' => $idFK_codiCentre_reparador,
            // 'idFK_codiCentre' => $idFK_codiCentre[0],   //acceder a la posicion 0 del CSV
            'idFK_idProfessor' => $idFK_professor
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('tiquet');
        $builder->select('id_tiquet');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener id_tiquet random
        $id_random = array_rand($result);
        return $result[$id_random]->id_tiquet;
    }

    public function obtenirTiquets()
    {
        return $this->findAll();
    }

    // public function afegirTiquets($id) {
    //     // $tiquet_model = new TiquetModel();
    //     $this->insert([
    //         'id_tiquet' => $id
    //     ]); 
    //     // [
    //     //     // 'descripcio_avaria' => $descripcio_avaria,
    //     //     // 'data_alta' => $data_alta,
    //     //     // 'estat_tiquet' => $estat,
    //     //     // 'idFk_dispositiu' => $idFK_tipus_dispositiu,
    //     //     // 'centre_emitent' => $idFK_codiCentre_emitent,
    //     //     // 'centre_reparador' => $idFK_codiCentre_reparador
    //     // ];

    // }

    public function afegirTicket($id_tiquet, $codi_equip, $idFK_dispositiu, $descripcio_avaria, $data_alta, $estat_tiquet, $idFK_codiCentre_emitent, $idFK_codiCentre_reparador, $idFK_professor) {
        $this->insert([
            'id_tiquet' => $id_tiquet,
            'codi_equip' => $codi_equip,
            'idFK_dispositiu' => $idFK_dispositiu,
            'descripcio_avaria' => $descripcio_avaria,
            'data_alta' => $data_alta,
            'estat_tiquet' => $estat_tiquet,
            'idFK_codiCentre_emitent' => $idFK_codiCentre_emitent,
            'idFK_codiCentre_reparador' => $idFK_codiCentre_reparador,
            'idFK_idProfessor' => $idFK_professor

        ]);
    }
    
    public function borrarTicket($id_ticket) {
        return $this->where('id_tiquet', $id_ticket)->delete();
    }
    
}
