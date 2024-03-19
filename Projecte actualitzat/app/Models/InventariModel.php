<?php

namespace App\Models;

use CodeIgniter\Model;

class InventariModel extends Model
{
    protected $table            = 'inventari';
    protected $primaryKey       = 'id_inventari';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['data_compra', 'preu', 'idFK_tipus_inventari', 'idFK_codi_centre', 'idFK_intervencio'];

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

    public function addInventari($data_compra, $preu, $idFK_tipus_inventari, $idFK_codi_centre, $idFK_intervencio) {

        $this->insert([
            'data_compra' => $data_compra,
            'preu' => $preu,
            'idFK_tipus_inventari' => $idFK_tipus_inventari,
            'idFK_codi_centre' => $idFK_codi_centre,
            'idFK_intervencio' => $idFK_intervencio
        ]);
    }
}
