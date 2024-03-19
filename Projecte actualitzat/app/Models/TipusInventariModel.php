<?php

namespace App\Models;

use CodeIgniter\Model;

class TipusInventariModel extends Model
{
    protected $table            = 'tipus_inventari';
    protected $primaryKey       = 'id_tipus_inventari';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tipus_inventari'];

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

    public function addTipusInventari($tipus_inventari){
        $this->insert([
            'tipus_inventari' => $tipus_inventari
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('tipus_inventari');
        $builder->select('id_tipus_inventari');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener id_tipus_inventari random
        $id_TipusInventari_random = array_rand($result);

        return $result[$id_TipusInventari_random]->id_tipus_inventari;
    }
}
