<?php

namespace App\Models;

use CodeIgniter\Model;

class TipusIntervencioModel extends Model
{
    protected $table            = 'tipus_intervencio';
    protected $primaryKey       = 'id_tipus_intervencio';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_tipus_intervencio', 'tipus_intervencio'];

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

    public function addTipusIntervencio($id_tipus_intervencio, $tipus_intervencio) {
        $this->insert([
            'id_tipus_intervencio' => $id_tipus_intervencio,
            'tipus_intervencio' => $tipus_intervencio
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('tipus_intervencio');
        $builder->select('id_tipus_intervencio');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener id_tipus_intervencio random
        $id_random = array_rand($result);

        return $result[$id_random]->id_tipus_intervencio;
    }
}
