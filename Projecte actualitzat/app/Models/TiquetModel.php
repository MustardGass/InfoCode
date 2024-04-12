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

    public function addTiquets($id_tiquet, $codi_equip, $descripcio_avaria, $data_alta, $data_ultim_modif, $idFK_dispositiu, $idFK_codiCentre, $idFK_professor){
        $this->insert([
            'id_tiquet' => $id_tiquet,
            'codi_equip' => $codi_equip,
            'descripcio_avaria' => $descripcio_avaria,
            'data_alta' => $data_alta,
            'data_ultima_modificacio' => $data_ultim_modif,
            'idFK_dispositiu' => $idFK_dispositiu,
            'idFK_codiCentre' => $idFK_codiCentre[0],   //acceder a la posicion 0 del CSV
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
}
