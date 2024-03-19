<?php

namespace App\Models;

use CodeIgniter\Model;

class IntervencioModel extends Model
{
    protected $table            = 'intervencio';
    protected $primaryKey       = 'id_intervencio';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_intervencio', 'descripcio', 'estudi_alumne', 'curs_alumne', 'data_intervencio', 'idFK_tipus_intervencio', 'idFK_tiquet', 'idFK_alumne', 'idFK_professor'];

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

    public function addIntervencio($id_intervencio, $descripcio, $estudi_alumne, $curs_alumne, $data_intervencio, $idFK_tipus_intervencio, $idFK_tiquet, $idFK_alumne, $idFK_professor) {
        $this->insert([
            'id_intervencio' => $id_intervencio,
            'descripcio' => $descripcio,
            'estudi_alumne' => $estudi_alumne,
            'curs_alumne' => $curs_alumne,
            'data_intervencio' => $data_intervencio,
            'idFK_tipus_intervencio' => $idFK_tipus_intervencio,
            'idFK_tiquet' => $idFK_tiquet,
            'idFK_alumne' => $idFK_alumne,
            'idFK_professor' => $idFK_professor
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('intervencio');
        $builder->select('id_intervencio');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener correu_electronic random
        $intervencio_random = array_rand($result);

        return $result[$intervencio_random]->id_intervencio;
    }
}
