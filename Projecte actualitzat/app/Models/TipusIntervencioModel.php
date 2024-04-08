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
        $query = $this->db->query('SELECT id_tipus_intervencio FROM tipus_intervencio ORDER BY RAND() LIMIT 1');
        $row = $query->getRow();
    
        if ($row) {
            return $row->id_tipus_intervencio;
        } else {
            return null; // O manejar de otra forma cuando no se encuentra ningún registro
        }
    }
    
}
