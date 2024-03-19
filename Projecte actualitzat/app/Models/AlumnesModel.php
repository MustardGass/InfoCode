<?php

namespace App\Models;

use CodeIgniter\Model;

class AlumnesModel extends Model
{
    protected $table            = 'alumne';
    protected $primaryKey       = 'correu_alumne';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['correu_alumne', 'idFK_codi_centre'];

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

    public function addAlumnes($correu_alumne, $idFK_codi_centre) {
        $this->insert([
            "correu_alumne" => $correu_alumne,
            "idFK_codi_centre" => $idFK_codi_centre[0]
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('alumne');
        $builder->select('correu_alumne');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener correu_electronic random
        $correu_random = array_rand($result);

        return $result[$correu_random]->correu_alumne;
    }

    public function getAlumne() {
        return $this->findAll();
    }
}
