<?php

namespace App\Models;

use CodeIgniter\Model;

class CentreModel extends Model
{
    protected $table            = 'centre';
    protected $primaryKey       = 'codi_centre';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['codi_centre', 'nom', 'direccio', 'telefon', 'correu', 'poblacio', 'comarca', 'idFK_SSTT'];

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

    public function addCentre($codi, $nom, $direccio, $telefon, $correu, $poblacio, $comarca, $idFK_SSTT){

        $this->insert([
            "codi_centre" => $codi,
            "nom" => $nom,
            "direccio" => $direccio,
            "telefon" => $telefon,
            "correu" => $correu,
            "poblacio" => $poblacio,
            "comarca" => $comarca,
            "idFK_SSTT" => $idFK_SSTT
        ]);
    }

    public function obtindreID() {
        $builder = $this->db->table('centre');
        $builder->select('codi_centre');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener idFK_codiCentre
        $codiCentre_random = array_rand($result);

        return $result[$codiCentre_random]-> codi_centre;
    }
}
