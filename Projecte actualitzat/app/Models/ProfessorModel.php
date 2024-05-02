<?php

namespace App\Models;

use CodeIgniter\Model;

class ProfessorModel extends Model
{
    protected $table            = 'professor';
    protected $primaryKey       = 'id_xtec';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_xtec', 'nom', 'cognoms', 'correu', 'idFK_codi_centre'];

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

    //guardar info del csv ingresado por el seeder
    public function addProfessors($id_xtec, $nom, $cognoms, $correu, $idFK_codi_centre) {
        
        $this->insert([
            'id_xtec' => $id_xtec,
            'nom' => $nom,
            'cognoms' => $cognoms,
            'correu' => $correu,
            'idFK_codi_centre' => $idFK_codi_centre[0]  //acceder a la posi codi_centre del fichero csv
        ]);
    }

    public function registrarProfessor($dades) {
        return $this->insert($dades);
    }

    // public function registrarProfessor($id_xtec, $nom, $cognoms, $correu, $idFK_codi_centre) {
    //     $this->insert([
    //         'id_xtec' => $id_xtec,
    //         'nom' => $nom,
    //         'cognoms' => $cognoms,
    //         'correu' => $correu,
    //         'idFK_codi_centre' => $idFK_codi_centre
    //     ]);
    // }


    public function obtindreID() {
        $builder = $this->db->table('professor');
        $builder->select('id_xtec');
        $query = $builder->get();
        $result = $query->getResult();

        //obtener id_xtec random
        $id_random = array_rand($result);
        
        return $result[$id_random]->id_xtec;
    }
}
