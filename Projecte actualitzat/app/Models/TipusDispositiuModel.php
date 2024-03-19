<?php

namespace App\Models;

use CodeIgniter\Model;

class TipusDispositiuModel extends Model
{
    protected $table            = 'tipus_dispositiu';
    protected $primaryKey       = 'id_tipus';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tipus'];

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

    public function addDispositius($tipus) {
        $this->insert([
            "tipus" => $tipus
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('tipus_dispositiu');
        $builder->select('id_tipus');
        $query = $builder->get();   //devuelve un objeto
        $result = $query->getResult();  //obtener los resultados de la consulta

        //obtener un id_tipus random    
        $id_random = array_rand($result);

        return $result[$id_random]->id_tipus;
    }
}
