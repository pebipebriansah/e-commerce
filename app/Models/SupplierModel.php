<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'supplier';
    protected $primaryKey       = 'id_supplier';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = false;
    protected $allowedFields    = [];

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

    public function getLastID(){
    // get last id_supplier
    $builder = $this->db->table('supplier');
    $builder->select('id_supplier');
    $builder->orderBy('id_supplier', 'DESC');
    $builder->limit(1);
    $query = $builder->get();
    if ($query->getNumRows() > 0) {
        $row = $query->getRow();
        return $row->id_supplier;
    } else{
        return null;
    }
}
    public function getDataSupplierById($id_supplier){
        $builder = $this->db->table('supplier');
        $builder->where('id_supplier', $id_supplier);
        $query = $builder->get();
        return $query->getResultArray();
    }
    public function getById($id_supplier){
        $builder = $this->db->table('supplier');
        $builder->where('id_supplier', $id_supplier);
        $query = $builder->get();
        return $query->getRowArray();
    }
}